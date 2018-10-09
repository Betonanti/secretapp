<template>
    <div class="well">

        <div class="alert alert-danger" v-for="item in response.message">{{item}}</div>


        <div class="form-group">
            <label for="secret">Secret:</label>
            <input type="text" class="form-control" id="secret" v-model="secret">
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="expireAfter">Expire after:</label>
                    <input type="date" class="form-control" id="expireAfter"  v-model="expireAfter">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="expireAfterViews">Expire after views:</label>
                    <input type="number" class="form-control" id="expireAfterViews" v-model="expireAfterViews">
                </div>
            </div>

            <button type="button" class="btn btn-success" @click="save" >Save <span class="glyphicon glyphicon-save"></span></button>

            <div class="alert alert-success hash" v-if="response.hash != ''"><i><b>Success!</b></i> Your hash: <b>{{response.hash}}</b></div>

        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                expireAfterViews:1,
                secret:'',
                expireAfter: Date.now(),
                response:{'message':[],'hash':''}
            }
        },
        methods:{
            save:function(){
                var global = this.response;
                global.message = [];
                this.check();

                axios.post('/secret',{
                    secret:this.secret,
                    expireAfter: this.expireAfter,
                    expireAfterViews:this.expireAfterViews
                }).then(response => {
                    global.hash = response.data.hash;

                    this.clear();

                }).catch(error => {
                    $.each(error.response.data, function(key, value){
                        error.response.data[key].forEach(function(e){
                            global.message.push(e);
                        });
                    })
                });
            },
            clear:function(){
                this.expireAfterViews = 1;
                this.expireAfter  = '';
                this.secret = '';
            },
            check:function(){
                if(this.response.hash != ''){
                    this.response.hash = '';
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

    .hash{
        width:100%;
        margin:10px;
    }
</style>