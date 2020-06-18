<template>
	<li class="dropdown" v-cloak>
        <a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications">
            <i id="bell" :data-count="notifications.length" class="fas fa-bell icon-red circle"></i>
        </a>
        <ul class="app-notification dropdown-menu dropdown-menu-right">
            <li class="app-notification__title">
                <p v-if="notifications.length == 0">No new notifications.</p>
                <p v-else v-text="'You have ' + notifications.length + ' new notification(s).'"></p>
            </li>
            <div class="app-notification__content" v-for="notification in notifications">
                <li>
                    <a class="app-notification__item" :href="notification.data.link" @click="markAsRead(notification)">
                        <span class="app-notification__icon">
                            <span class="fa-stack fa-lg">
                                <i :class="toggleColor(notification.type)"></i>
                                <i class="fa fa-hdd-o fa-stack-1x fa-inverse"></i>
                            </span>
                        </span>
                        <div>
                            <p class="app-notification__message" v-text="notification.data.message"></p>
                            <p class="app-notification__meta">{{ time(notification.created_at) }}</p>
                        </div>
                    </a>
                </li>
            </div>
        </ul>
    </li>
</template>

<script>
    var moment = require('moment');

	export default {
		data() {
			return { notifications: false }
		},

		created() {
			axios.get('/admin/notifications')
				.then(response => this.notifications = response.data);
		},

		methods: {
			markAsRead(notification) {
				axios.delete(`/admin/notifications/${notification.id}`);
			},

            time(created_at) {
                return moment(created_at).fromNow();
            },

            toggleColor(type) {
                if (type == "App\\Notifications\\AlmostOutOfStockNotification") {
                    return 'fa fa-circle fa-stack-2x text-warning';
                }

                return 'fa fa-circle fa-stack-2x text-danger';
            }
		}
	};
</script>

<style>
    *.icon-blue {color: #0088cc}
    *.icon-red {color: white}
    #bell {
        width: 40px;
        text-align: center;
        vertical-align: middle;
        position: relative;
    }
    .circle:after{
        content:attr(data-count);
        position: fixed;
        background: red;
        height:1rem;
        top:0.5rem;
        right:0.75rem;
        width:1rem;
        text-align: center;
        line-height: 1rem;;
        font-size: 0.5rem;
        border-radius: 50%;
        color:white;
        border:1px;
        left: 92.5%;
    }
    .circle[data-count="0"]:after{ display : none; }
</style>
