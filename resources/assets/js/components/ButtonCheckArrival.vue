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
                idAbsenteeism: '',
                errors: [],
                date: '',
                hoursAbsent: 0,
                permissionDate: '',
                arrivalDate: '',
            }
        },

        methods: {

            confirmHours(){
                swal({
                    title: `Confirme las horas de ausentismo`,
                    type: 'question',
                    html: '<span>Horas ausente:</span><br/><br/>' +
                          '<strong>*Este calculo no tiene encuenta los días festivos</strong><br/><br/>' +
                          '<span>'+this.permissionDate+' - '+this.arrivalDate+' = '+this.hoursAbsent+'hrs</span><br/><br/>' +
                          '<input value="'+this.hoursAbsent+'" type="number" class="form-control" id="hours" />',
                    confirmButtonText: 'Continuar',
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        let hoursAbsent = document.getElementById('hours').value
                        let data = {hoursAbsent}
                        return axios.put('/formalities/formato-ausentismo/confirmHoursAbsent/'+this.idAbsenteeism, data)
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
                                let messages = []
                                if(err.response.data.errors === null || err.response.data.errors === undefined){
                                    messages.push(err.response.data.message)
                                }else{
                                    this.errors = err.response.data.errors
                                    messages = Object.keys(this.errors).map((key) => {
                                        return `<span>${this.errors[key][0]}</span><br>`
                                    })
                                }
                                return swal({
                                    type: 'error',
                                    width: 650,
                                    showCancelButton: true,
                                    cancelButtonText: 'Continuar',
                                    showConfirmButton: false,
                                    html: messages.toString(),
                                    preConfirm: () => {
                                        location.reload()
                                    }
                                })
                            })
                    },
                    allowOutsideClick: false
                })
            },

            submit(){
                swal({
                    title: `¿${this.title}?`,
                    type: 'question',
                    html: '<span>Ingrese la fecha y hora de llegada.</span><br /><br />'+'<input type="datetime-local" class="form-control" id="date" />',
                    showCancelButton: true,
                    confirmButtonText: 'Continuar',
                    cancelButtonText: 'Cancelar',
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        this.date = document.getElementById('date').value
                        let data = {'date':this.date}
                        return axios.put(this.route, data)
                            .then((res) => {
                                this.hoursAbsent = res.data.hours
                                this.idAbsenteeism = res.data.idAbsenteeism
                                this.permissionDate = res.data.permission_date
                                this.arrivalDate = res.data.arrival_date

                                return swal({
                                    type: 'success',
                                    confirmButtonText: 'Continuar',
                                    text: res.data.message,
                                })
                            })
                            .catch((err) => {
                                let messages = []
                                if(err.response.data.errors === null || err.response.data.errors === undefined){
                                    messages.push(err.response.data.message)
                                }else{
                                    this.errors = err.response.data.errors
                                    messages = Object.keys(this.errors).map((key) => {
                                        return `<span>${this.errors[key][0]}</span><br>`
                                    })
                                }

                                return swal({
                                    type: 'error',
                                    width: 600,
                                    showCancelButton: true,
                                    cancelButtonText: 'Continuar',
                                    showConfirmButton: false,
                                    html: messages.toString()
                                })
                            })
                    },
                    allowOutsideClick: () => !swal.isLoading()
                }).then((result) => {
                    if (result.value && this.hoursAbsent > 0) {
                        this.confirmHours()
                    }else{
                        swal({
                            type: 'error',
                            width: 600,
                            text: 'Proceso cancelado o fallido, intente nuevamente'
                        })
                        location.reload()
                    }
                })
            }
        },
    }
</script>

<style scoped>

</style>