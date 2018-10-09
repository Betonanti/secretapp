<template>
    <div class="well">

        <div class="alert alert-danger" v-for="item in response.message">{{item}}</div>

        <div class="form-group">
            <label for="hash">Hash:</label>
            <input type="text" class="form-control" id="hash" v-model="hash">
        </div>
        <button type="button" class="btn btn-success" @click="save" >Get my secret <span class="glyphicon glyphicon-floppy-save"></span></button>

        <div class="alert alert-success hash" v-if="response.secret != ''">
            <i><b>Success!</b></i> Your secret: <b>{{response.secret}}</b>
        </div>


    </div>
</template>

<script>
    export default {
        data(){
            return{
                hash:'',
                response:{'message':[],'secret':''}
            }
        },
        methods:{
            save:function(){
                var global = this.response;
                global.message = [];
                this.check();

                axios.get('/secret/'+this.hash
                ).then(response => {
                    global.secret = response.data.secret;
                    this.clear();

                }).catch(error => {

                    $.each(error.response.data, function(key, value){
                        error.response.data[key].forEach(function(e){
                            global.message.push(e);
                        });
                    });
                });
            },
            clear:function(){
                this.hash = '';
            },
            check:function(){
                if(this.response.secret != ''){
                    this.response.secret = '';
                }
            }
        }
    }
</script>

<style scoped>
    button{
        width:100%;
        font-weight:700;
    }
    .alert{
        margin:10px !important;
    }
</style>