<template>
    <div class="site-menubar">
        <div class="site-menubar-body">
            <div>
                <div>
                    <ul class="site-menu" data-plugin="menu">
                        <template v-for="group in menu">
                            <menu-group>{{ group.title }}</menu-group>

                            <menu-item v-for="item in group.items" :key="item.title"
                                       :href="item.route"
                                       :icon="item.icon">
                                {{ item.title }}
                            </menu-item>
                        </template>
                    </ul>
                </div>
            </div>
        </div>
        <div class="site-menubar-footer"></div>
    </div>
</template>

<script>
    import menu from 'menu';
    import MenuGroup from './Sidebar/MenuGroup';
    import MenuItem from './Sidebar/MenuItem';

    export default {
        components: {
            MenuGroup, MenuItem
        },

        data() {
            return {
                menu: menu
            }
        },

        mounted() {
            this.initLayout()
        },

        methods: {
            initLayout() {
                let type = this.$site().getState('menubarType');
                this.$site().setBodyClasses(`animsition site-menubar-${type}`)
            }
        }
    }
</script>