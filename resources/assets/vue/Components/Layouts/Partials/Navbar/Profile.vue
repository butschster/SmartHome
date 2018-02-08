<template>
    <li class="dropdown">
        <a class="nav-link navbar-avatar dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false"
           data-animation="scale-up" role="button">
          <span class="avatar avatar-online">
            <img :src="user.avatar" @error="avatarError">
            <i></i>
          </span>
        </a>
        <ul class="dropdown-menu" role="menu">
            <li role="presentation">
                <router-link :to="profileLink" role="menuitem" class="dropdown-item">
                    <icon name="user"></icon>
                    Профиль
                </router-link>
            </li>
            <li class="divider" role="presentation"></li>
            <li role="presentation">
                <a href="#" role="menuitem" class="dropdown-item" @click="logout">
                    <icon name="power"></icon>
                    Выход
                </a>
            </li>
        </ul>
    </li>
</template>

<script>
    export default {
        data() {
            return {
                user: window.settings.user
            }
        },
        methods: {
            logout() {

            }
        },
        computed: {
            profileLink() {
                return {
                    // name: USER_PROFILE,
                    // params: {id: this.user.id}
                }
            },
        }
    }
</script>