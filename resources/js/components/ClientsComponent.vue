
<template>
<div class="container">
        <div class="row">
            <spinner v-show="loading"></spinner>
          <div class="col-sm" v-for="cliente in clientes">
                <div class="card text-center" style="width: 18rem; margin-top: 50px;">
                    <img style=" margin-top: 25px;
                    width: 60%; background-color: #efefef;" class="card-img-top rounded-circle mx-auto d-block"  v-bind:src="cliente.avatar" v-bind:alt="cliente.avatar">
                 <div class="card-body">
                    <h5 class="card-title">{{cliente.name}}</h5>
                    <p class="card-text">{{cliente.bio}}</p>
                    <a v-bind:href="cliente.slug" class="btn btn-primary">More..</a>
                    </div>
                 </div>
            </div>
        </div>
    </div>
</template>
<style>

</style>
<script>
export default {

    data(){
        return {
            clientes: [],
            loading:true
                }
        },
    mounted(){
           axios
                .get('http://ux-camp.herokuapp.com/cliente')
                //.get('http://127.0.0.1:8000/cliente')
                .then((res) => {
                    this.clientes = res.data
                    this.loading = false
                })
    }
}
</script>