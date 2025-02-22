<template>
    <div>
        <div id="notification-button" @click="visible = !visible" :class="visible ? 'bg-white border-0 shadow-lg' : 'border border-gray-400'" class="hover:bg-white hover:text-gray-700 hover:shadow-lg hover:border-opacity-0 rounded-full h-12 w-12 cursor-pointer font-bold text-2xl justify-center items-center flex text-gray-800">
            <div class="relative float-right" v-if="notifications.length > 0">
                <div class="absolute -ml-6 -mt-8">
                    <div class="bg-blue-400 text-white w-8 h-8 rounded-full text-xs flex items-center justify-center">{{ notifications.length | abbreviate }}</div>
                </div>
            </div>
            <i class="las la-bell"></i>
        </div>
        <div class="h-0 w-0" v-if="visible" id="notification-center">
            <div class="absolute left-0 top-0 sm:relative w-screen zoom-out-entrance anim-duration-300 h-5/7-screen sm:w-64 sm:h-108 flex flex-row-reverse">
                <div class="z-50 sm:rounded-lg shadow-lg h-full w-full bg-white md:mt-2 overflow-y-hidden flex flex-col">
                    <div @click="visible = false" class="sm:hidden p-2 cursor-pointer flex items-center justify-center border-b border-gray-200">
                        <h3 class="font-semibold hover:text-blue-400">Close</h3>
                    </div>
                    <div class="overflow-y-auto flex flex-col flex-auto">
                        <div :key="notification.id" v-for="notification of notifications" class="notice border-b border-gray-200">
                            <div class="p-2 cursor-pointer" @click="triggerLink( notification )">
                                <div class="flex items-center justify-between">
                                    <h1 class="font-semibold text-gray-700">{{ notification.title }}</h1>
                                    <ns-close-button @click="closeNotice( $event, notification )"></ns-close-button>
                                </div>
                                <p class="py-1 text-gray-600 text-sm">{{ notification.description }}</p>
                            </div>
                        </div>
                        <div v-if="notifications.length === 0" class="h-full w-full flex items-center justify-center">
                            <div class="flex flex-col items-center">
                                <i class="las la-laugh-wink text-5xl text-gray-800"></i>
                                <p class="text-gray-600 text-sm">Nothing to care about !</p>
                            </div>
                        </div>
                    </div>
                    <div class="cursor-pointer">
                        <h3 @click="deleteAll()" class="text-sm p-2 flex items-center justify-center hover:bg-red-100 w-full text-red-400 font-semibold hover:text-red-500">{{ __( 'Clear All' ) }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { nsHttpClient, nsSnackBar } from '@/bootstrap';
import { __ } from '@/libraries/lang';
import nsPosConfirmPopupVue from '@/popups/ns-pos-confirm-popup.vue';
export default {
    name: 'ns-notifications',
    data() {
        return {
            notifications: [],
            visible: false,
            interval: null,
        }
    },
    mounted() {
        document.addEventListener( 'click', this.checkClickedItem );
        
        if ( ns.websocket.enabled ) {
            Echo.private( `ns.private-channel` )
                .listen( 'App\\Events\\NotificationDispatchedEvent', (e) => {
                    this.pushNotificationIfNew( e.notification );
                })
                .listen( 'App\\Events\\NotificationDeletedEvent', (e) => {
                    this.deleteNotificationIfExists( e.notification );
                });
        } else {
            this.interval   =   setInterval( () => {
                this.loadNotifications();
            }, 15000 );
        }

        this.loadNotifications();
    },
    destroyed() {
        clearInterval( this.interval );
    },
    methods: {
        __,
        pushNotificationIfNew( notification ) {
            const exists     =   this.notifications.filter( _notification => _notification.id === notification.id ).length > 0;

            console.log( notification );

            if ( ! exists ) {
                this.notifications.push( notification );
            }
        },
        deleteNotificationIfExists( notification ) {
            const exists     =   this.notifications.filter( _notification => _notification.id === notification.id );

            if ( exists.length > 0 ) {
                const index     =   this.notifications.indexOf( exists[0] );
                this.notifications.splice( index, 1 );
            }
        },
        deleteAll() {
            Popup.show( nsPosConfirmPopupVue, {
                title: __( 'Confirm Your Action' ),
                message: __( 'Would you like to clear all the notifications ?' ),
                onAction: ( action ) => {
                    if ( action ) {
                        nsHttpClient.delete( `/api/nexopos/v4/notifications/all` )
                            .subscribe( result => {
                                nsSnackBar.success( result.message ).subscribe();
                            })
                    }
                }
            })
        },
        checkClickedItem( event ) {
            let clickChildrens;

            if ( document.getElementById( 'notification-center' ) ) {
                clickChildrens        =   document.getElementById( 'notification-center' ).contains( event.srcElement );
            } else {
                clickChildrens        =   false;
            }
            
            const isNotificationButton  =   document.getElementById( 'notification-button' ).contains( event.srcElement );

            if ( ! clickChildrens && ! isNotificationButton && this.visible ) {
                this.visible    =   false;
            }
        },

        loadNotifications() {
            nsHttpClient.get( '/api/nexopos/v4/notifications' )
                .subscribe( notifications => {
                    this.notifications  =   notifications;
                })
        },

        triggerLink( notification ) {
            if ( notification.url !== 'url' ) {
                return window.open( notification.url, '_blank' );
            }
        },

        closeNotice( event, notification ) {
            nsHttpClient.delete( `/api/nexopos/v4/notifications/${notification.id}` )
                .subscribe( result => {
                    this.loadNotifications();
                });
            event.stopPropagation();
        }
    }
}
</script>