<template>
    <button @click="submit" class="btn btn-outline-danger"><i class="fa fa-ban fa-fw"></i> {{ title }}</button>
</template>

<script>
    export default {
        name: "ButtonInactive",

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
                    text: 'Detalle el motivo de la acción.',
                    type: 'question',
                    input: 'text',
                    inputAttributes: {
                        autocapitalize: 'off'
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Continuar',
                    cancelButtonText: 'Cancelar',
                    showLoaderOnConfirm: true,
                    preConfirm: (nota) => {
                        let data = {nota}
                        axios.put(this.route, data)
                            .then((res) => {
                                swal({
                                    type: 'warning',
                                    text: res.data.message,
                                    preConfirm: () => {
                                        location.reload()
                                    }
                                })
                            })
                            .catch((err) => {
                                swal({
                                    type: 'error',
                                    html: err.response.data.errors.nota[0]
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