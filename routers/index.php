<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aula 22 e 23 - Vuejs do jeito ninja!</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
</head>
<body>
    <div id="app">
        <br><br><br>
        <div class="container">
            <h1 ref="title">{{ titulo }}</h1>  
            <ul>
                <li><router-link :to="{name:'transformers'}">Transformers</router-link></li>
                <li><router-link :to="{name:'gameOfThrones'}">Game Of Thrones</router-link></li>
            </ul>
            <router-view></router-view>
        </div>
    </div>  
    
    <template id="transformers">
        <div>
            <div class="row">
                <div class="col">
                <h4>Transformers</h4>
                    <ul>
                        <li v-for="item in transformers"><router-link :to="{ name:'transformersContent', params:{name: item.slug}}">{{ item.name }}</router-link></li>
                    </ul>
                </div>
                <div class="col">
                <router-view></router-view>
                </div>
            </div>
            
        </div>
    </template>

    <template id="gameOfThrones">
        <div>
            <h4>Game Of Thrones</h4>
            <ul>
                <li v-for="item in gameOfThrones">{{ item.name }}</li>
            </ul>
        </div>
    </template>

    <template id="transformerContent">
        <div>
            <h3>Conteúdo Transformers</h3>
            {{ $route.params.name }}
        </div>
    </template>

   
    <script src="https://unpkg.com/vue"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/vue-router/dist/vue-router.js"></script>
    <script>   
       
        var Transformers = Vue.component('transformers', {
            template:"#transformers",
            data() {
                return {
                    transformers:[
                        {name: 'Optmus Prime', slug:'optmus-prime'},
                        {name: 'Bumble Bee', slug:'bumble-bee'},
                        {name: 'Megatron', slug:'megatron'}
                    ]
                }
            },
        });

        var GameOfThrones = Vue.component('game-of-thrones', {
            template:"#gameOfThrones",
            data() {
                return {
                    gameOfThrones:[
                        {name: 'Jon Snow'},
                        {name: 'Daenerys Targaryen'},
                        {name: 'Tyron'}
                    ]
                }
            },
        });

        var TransformersContent = Vue.component('transformers-content',{
            template:'#transformerContent'
        });

        const router = new VueRouter({
            mode: 'history',
            routes: [
                {path:'/transformers',name:'transformers', component: Transformers,
                    children:[
                        {path: ':name', name:'transformersContent', component: TransformersContent }
                    ]
                },
                {path:'/game-of-thrones',name:'gameOfThrones', component: GameOfThrones},
            ]
        })

        var app = new Vue({
            el:"#app",
            router,
            data:{
                titulo: "Vuejs do jeito ninja",
            }        
        });
    </script>

</body>
</html>