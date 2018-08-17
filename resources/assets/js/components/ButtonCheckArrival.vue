<template>
    <button @click="submit" class="btn btn-sm btn-success"><i class="fa fa-stopwatch fa-fw"></i> {{ title }}</button>
</template>

<script>
    export default {
        name: "ButtonCheckArrival",

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

        data: function () {
            return {
                errors: [],
            }
        },

        methods: {
            submit(){
                swal({
                    title: `¿${this.title}?`,
                    text: 'Ingrese la hora de llegada.',
                    type: 'question',
                    html: '<input type="date" class="form-control" id="date" /><input type="time" class="form-control" id="time" />',
                    showCancelButton: true,
                    confirmButtonText: 'Continuar',
                    cancelButtonText: 'Cancelar',
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        let date = document.getElementById('date').value
                        let time = document.getElementById('time').value
                        let data = {time,date}
                        axios.put(this.route, data)
                            .then((res) => {
                                swal({
                                    type: 'success',
                                    text: res.data.message,
                                    preConfirm: () => {
                                        location.reload()
                                    }
                                })
                            })
                            .catch((err) => {
                                this.errors = err.response.data.errors
                                let messages = Object.keys(this.errors).map((key) => {
                                    return `<span>${this.errors[key][0]}</span><br>`
                                })
                                swal({
                                    type: 'error',
                                    width: 600,
                                    html: messages.toString()
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