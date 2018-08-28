<template>
    <button @click="submit" class="btn btn-sm btn-success"><i class="fa fa-check-circle fa-fw"></i> {{ title }}</button>
</template>

<script>
    export default {
        name: "ButtonApprove",

        props: {
            title:{
                String,
                required: true
            },
            route:{
                String,
                required: true
            },
        },

        methods: {
            submit(){
                swal({
                    title: `¿${this.title} solicitud?`,
                    type: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Continuar',
                    cancelButtonText: 'Cancelar',
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        return axios.put(this.route)
                            .then((res) => {
                                return swal({
                                    type: 'success',
                                    text: res.data.message,
                                    preConfirm: () => {
                                        location.reload()
                                    }
                                })
                            })
                            .catch((err) => {
                                return swal({
                                    type: 'error',
                                    html: err.response.data.message
                                })
                            })
                    },
                    allowOutsideClick: () => !swal.isLoading()
                })
                }
        },
    }
</script>

<style scoped>

</style>