<template>
    <router-link class="site-menu-item" tag="li" :to="href">
        <a>
            <i class="site-menu-icon" :class="icon" aria-hidden="true" v-if="hasIcon"></i>

            <span class="site-menu-title">
                <slot></slot>
            </span>
            <div class="site-menu-badge" v-if="hasBadge">
                <span class="badge badge-pill" :class="badgeClass">{{ badge }}</span>
            </div>
        </a>
    </router-link>
</template>

<script>
    export default {
        props: {
            icon: String,
            badge: [String, Number],
            badgeClass: {
                type: String,
                default: 'badge-success'
            },
            href: {
                type: [String, Object],
                required: true
            }
        },
        computed: {
            hasIcon() {
                return this.icon && this.icon.length > 0
            },
            hasBadge() {
                return this.badge && this.badge.length > 0
            }
        }
    }
</script>