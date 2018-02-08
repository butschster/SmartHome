<template>
    <li class="nav-item dropdown" v-if="total">
        <span class="nav-link"
              data-toggle="dropdown"
              title="Уведомления"
              aria-expanded="false"
              data-animation="scale-up"
              role="button">
            <icon name="bell"></icon>
            <span class="badge badge-pill badge-danger up">{{ total }}</span>
        </span>

        <div class="dropdown-menu dropdown-menu-right dropdown-menu-media" role="menu">
            <div class="dropdown-menu-header">
                <h5>Уведомления</h5>
                <span class="badge badge-round badge-danger">Новых: {{ total }}</span>
            </div>

            <div class="list-group">
                <div data-role="container">
                    <div data-role="content">
                        <a href="#"
                           @click.prevent="read(notification)"
                           class="list-group-item" role="menuitem"
                           v-for="notification in notifications"
                        >
                            <div class="media">
                                <div class="media-body">
                                    <div class="media-detail" v-html="notification.text"></div>
                                    <time class="media-meta">{{ notification.created_at | formated }}</time>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="dropdown-menu-footer">
                <a class="dropdown-item" href="javascript:void(0)" role="button" @click="clear" v-if="total">
                    <icon name="trash"></icon>
                    Очистить
                </a>
            </div>
        </div>
    </li>
</template>

<script>
    export default {
        data() {
            return {
                notifications: []
            }
        },
        methods: {
            clear() {

            },
            read(notification) {

            }
        },
        computed: {
            total() {
                return this.notifications.length;
            }
        }
    }
</script>