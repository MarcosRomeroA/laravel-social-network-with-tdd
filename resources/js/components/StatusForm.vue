<template>
    <div>
        <!--previene agregar el parametro body a la url-->
        <form @submit.prevent="submit">
            <div class="card-body">
                <textarea v-model="body" class="form-control border-0 bg-light" name="body" placeholder="¿Que estas pensando Marcos?"></textarea>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" id="create-status">Publicar</button>
            </div>
        </form>
        <div v-for="status in statuses" v-text="status.body"></div>
    </div>

</template>

<script>
    export default {
        data(){
            return{
                body: '',
                statuses: []
            }
        },
        methods: {
            submit(){
                axios.post('/statuses', {body: this.body})
                    .then(res =>{
                        this.statuses.push(res.data);
                        this.body = '';
                    })
                    .catch(err =>{
                        console.log(err.response.data);
                    })
            }
        }
    }
</script>
