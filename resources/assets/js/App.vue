<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <nav>
                <ul class="list-inline">
                    <li>
                        <router-link :to="{ name: 'home' }">首页</router-link>
                    </li>
                    <li v-if = "!$auth.check()" class="pull-right">
                        <router-link :to="{ name: 'login' }">登录</router-link>
                    </li>
                    <li v-if = "!$auth.check()" class="pull-right">
                        <router-link :to="{ name: 'register' }">注册</router-link>
                    </li>
                    <li v-if="$auth.check()" class="pull-right">
                        <a href="#" @click.prevent="$auth.logout()">退出</a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="panel-body">
            <router-view></router-view>
        </div>
    </div>
</template>
