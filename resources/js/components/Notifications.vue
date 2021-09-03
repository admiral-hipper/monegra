<template>
    <div style="display: inline-flex; margin-right: 4px;"
         @focusin="showPanel = true"
         v-click-outside="closeNotificationsPanel">
        <a class="nav-link dropdown-toggle pl-md-3 position-relative"
           href="javascript:void(0)"
           role="button"
           aria-haspopup="true"
           aria-expanded="false">
            <span>
                <i class="far fa-bell"
                   style="font-size: 17px;"></i>
            </span>

            <span v-if="countOfUnread"
                  class="badge badge-primary notify-no rounded-circle"
                  style="position: absolute; top: 0; right: -5px; padding: 4px 7px;"
                  v-text="countOfUnread"></span>
        </a>

        <div :class="['dropdown-menu dropdown-menu-left mailbox animated bounceInDown', {show: showPanel}]"
             style="padding: 0;">
            <ul class="list-style-none"
                style="overflow: auto; max-height: 65vh;">
                <li>
                    <div class="message-center notifications position-relative ps-container ps-theme-default" style="width: 300px;">
                        <a v-for="notification in notifications"
                           :key="notification.id"
                           :style="{opacity: notification['read_at'] ? 0.6 : 1}"
                           href="javascript:void(0)"
                           class="message-item d-flex align-items-center border-bottom px-3 py-2"
                           @click="openNotification(notification)">
                            <div class="w-100 d-inline-block v-middle pl-2">
                                <h6 class="message-title mb-0 mt-1"
                                    v-t="'notification'"></h6>

                                <i class="font-12 d-block text-muted notification-message"
                                   v-html="notification.data.message"></i>

                                <span class="font-12 text-nowrap d-block text-muted text-left"
                                      v-text="notification.timestamp"></span>
                            </div>
                        </a>

                        <a v-if="!notifications.length"
                           :key="'empty-notifications'"
                           href="javascript:void(0)"
                           class="message-item d-flex align-items-center border-bottom px-3 py-2"
                           style="pointer-events: none; padding: 12px 0!important; text-align: center;">
                            <div class="w-100 d-inline-block v-middle pl-2">
                                <span class="font-12 d-block text-muted"
                                      v-t="'no-notifications'"></span>
                            </div>
                        </a>
                    </div>
                </li>
            </ul>

            <span v-if="hasMore"
                  class="nav-link pt-3 text-center text-dark"
                  style="cursor: pointer; padding-bottom: 1rem; user-select: none;"
                  @click="getNotifications()">
                <strong v-t="'more'"></strong>

                <i class="fa fa-angle-down"></i>
            </span>

            <span v-if="idsOfNotificationsToRead.length"
                  class="nav-link pt-3 text-center text-dark"
                  style="cursor: pointer; padding-bottom: 1rem; user-select: none;"
                  @click="readNotifications(idsOfNotificationsToRead)">
                <strong v-t="'read-all'"></strong>
            </span>
        </div>
    </div>
</template>

<script>
    import ClickOutside from '../directives/clickOutside';
    import Swal from 'sweetalert2/dist/sweetalert2.js';
    import 'sweetalert2/src/sweetalert2.scss';

    export default {
        name: 'Notifications',
        directives: {
            ClickOutside
        },
        data: () => ({
            loading: false,
            notifications: [],
            idsOfReadNotifications: [],
            countOfUnread: 0,
            currentPage: 0,
            hasMore: false,
            showPanel: false
        }),
        computed: {
            idsOfNotificationsToRead() {
                return this.notifications.reduce((ids, notification) => {
                    if (!notification['read_at']) {
                        ids.push(notification.id);
                    }

                    return ids;
                }, []);
            }
        },
        methods: {
            async getNotifications() {
                if (this.loading) return;

                this.loading = true;

                const params = {
                    page: this.currentPage + 1
                };

                const {data} = await axios.get('/user/get-notifications', {params});

                const notifications = [];

                for (const notification of data.notifications) {
                    if (this.notifications
                            .findIndex(_notification => _notification.id === notification.id) !== -1) {
                        continue;
                    }

                    notification.timestamp = moment(notification.created_at).calendar();

                    notifications.push(notification);
                }

                this.notifications.push(...notifications);

                this.currentPage = data['current_page'];
                this.countOfUnread = data['count_of_unread'];
                this.hasMore = data['has_more'];

                await this.$nextTick();

                this.loading = false;
            },
            async readNotifications(ids = []) {
                if (this.loading
                    || (!ids.length && !this.idsOfNotificationsToRead.length)) return;

                if (!ids) {
                    ids = this.idsOfNotificationsToRead;
                } else {
                    ids = ids.filter(id => this.idsOfNotificationsToRead.includes(id));
                }

                if (!ids.length) return;

                this.loading = true;

                const {data} = await axios.post('/user/bulk-read-notifications', {
                    ['notification_ids']: ids
                });

                this.countOfUnread = data['count_of_unread'];
                this.currentPage = 0;

                this.notifications
                    .forEach(notification => {
                        if (!notification['read_at'] && ids.includes(notification.id)) {
                            notification['read_at'] = 'now';
                        }
                    });

                await this.$nextTick();

                this.loading = false;
            },
            closeNotificationsPanel({target}) {
                if (!this.showPanel
                    || (document.querySelector('.swal2-shown') && document.querySelector('.swal2-shown').contains(target))) return;

                this.showPanel = false;
            },
            openNotification({id, data}) {
                Swal.fire({
                    title: this.$t('notification'),
                    html: data.message,
                    timer: 0,
                    confirmButtonText: this.$t('close')
                });

                this.readNotifications([id]);
            }
        },
        async created() {
            await this.getNotifications();
        }
    }
</script>

<style>
    .list-style-none::-webkit-scrollbar {
        width: 8px;
    }

    .list-style-none::-webkit-scrollbar-track {
        box-shadow: inset 0 0 2px rgba(0, 0, 0, 0.2);
    }

    .list-style-none::-webkit-scrollbar-thumb {
        background-color: #7274e9;
    }

    .notification-message {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        height: 16px;
    }
</style>
