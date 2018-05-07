<template>
    <div>

        <h1>Laravel 5 – 酷炫的后台</h1>
        <btn @click="getUserInfo">请求用户信息</btn>
        <btn @click="getUserId">获取用户的id</btn>
    </div>

</template>

<script>
    export default ({
        methods: {
            getUserInfo() {
              console.log( this.$auth.user());
            },
            getUserId() {
                let app = this;
                app.$http.get('/auth/user').then(function(response) {
                     console.log(response.data);
                     console.log(app.$router);
                });
//                this.$auth.fetch({
//                    method: 'get',
//                    url:'/auth/user',
//                    success: function (response) {
//                        console.log(response.data);
//                    },
//                    error: function () {},
//                    // etc...
//                });
            }
        }
    })
</script>
