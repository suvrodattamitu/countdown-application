<template>
<div class="wrap">
    <div class="ninja_countdown_main_nav">
        <span>{{ 'Ninja Countdown' }}</span>
        <router-link v-for="menuItem in topMenus" :key="menuItem.route" 
        exact
        :to="{ name: menuItem.route }">
            {{ menuItem.title }}
        </router-link>
    </div>
    <div class="ninja_countdown_content">
        <router-view></router-view>
    </div>
</div>
</template>

<script type="text/babel">
export default {
    name: 'global_wrapper',
    data() {
        return {
            topMenus: []
        }
    },
    methods: {
        setTopmenu() {
            this.topMenus = [
                {
                    route: 'all-countdowns',
                    title: 'All Countdowns'
                },
                {
                    route: 'support',
                    title: 'Support'
                }
            ]
        }
    },
    mounted() {
        this.setTopmenu();
    }
}
</script>