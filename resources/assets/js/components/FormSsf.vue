<template>
    <form action="#" target="_blank" @submit.prevent="submit">
        <hr class="my-2">
        <h4 class="mb-2">Datos del informe</h4>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="date">Fecha de elaboración</label>
                <div class="input-group">
                    <input id="date" type="date" class="form-control" required>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="name">Elaboró</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nombre" :value=fullNameUser required readonly>
                </div>
            </div>
            <div class="form-check form-check-inline col-md-1">
                <input class="form-check-input" type="checkbox" id="reenvio">
                <label class="form-check-label" for="reenvio">
                    Reenvio
                </label>
            </div>
        </div>
        <hr class="my-2">
        <h4 class="mb-2">Información de los reportes</h4>
        <div class="form-row">
            <div class="form-group col-md-2">
                <div class="input-group">
                    <select @change="getReports" class="form-control" name="category_report" id="category_report">
                        <option value="0" disabled selected>Seleccione una categoria</option>
                        <option v-for="categoryReport in categoryReports" :value=categoryReport.id>{{ categoryReport.name }}</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-md-7">
                <div class="input-group">
                    <select  @change="addShippingPeriodsToSelect" class="form-control" name="reports" id="reports">
                        <option value="0" disabled selected>Seleccione un informe</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-md-2">
                <div class="input-group">
                    <select @click="activeButtonAdd" class="form-control" name="shipping_periods" id="shipping_periods">
                        <option value="0" disabled selected>Seleccione un periodo</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-md-1">
                <button id="buttonAdd" type="button" @click="addReport" class="btn btn-primary" disabled><i class="fa fa-plus"></i></button>
            </div>
        </div>
        <table class="table table-sm table-bordered text-center">
            <thead class="thead-light">
            <tr>
                <th rowspan="2" >Categoria</th>
                <th rowspan="2">Nombre</th>
                <th rowspan="2">Periodo</th>
                <th rowspan="2">Periocidad</th>
                <th colspan="3">Revisión y firmado digital </th>
                <th rowspan="2">Acción</th>
            </tr>
            <tr>
                <th>DI</th>
                <th>CO</th>
                <th>RF</th>
            </tr>
            </thead>
            <tbody id="bodyTable">
                <tr v-for="report in reportsSelected">
                    <td class="align-middle">{{ report.categorySelected.name }}</td>
                    <td class="align-middle text-left">{{report.reportSelected.archivo }} {{ report.reportSelected.nombre}}</td>
                    <td class="align-middle">{{ report.shippingPeriodSelected.name }}</td>
                    <td class="align-middle">{{ report.periodicitySelected.name }}</td>
                    <td class="align-middle">{{ report.signatures.direccion }}</td>
                    <td class="align-middle">{{ report.signatures.contador }}</td>
                    <td class="align-middle">{{ report.signatures.revisor }}</td>
                    <td class="align-middle"><button @click="removeReport(report)" type="button" class="btn btn-danger"><i class="fa fa-remove"></i></button></td>
                </tr>
            </tbody>
        </table>
        <div class="form-row">
            <button type="submit" class="btn btn-warning" v-show="isActiveBtn">
                <i class="fa fa-print fa-fw"></i> Imprimir
            </button>
        </div>
        <div class="modal fade" id="loading-pacman" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header">
                        <h5 class="modal-title">Cargando...</h5>
                    </div>
                    <div class="modal-body">
                        <loader-pacman></loader-pacman>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
    export default {
        name: "FormSsf",
        data: function () {
            return {
                reports: [],
                reportsSelected: [],
                isActiveBtn: false,
            }
        },

        props: {
            user: {
                Object,
                required: true
            },
            categoryReports: {
                Array,
                required: true
            },
            periodicities: {
                Object,
                required: true
            },
            signaturesType: {
                Object,
                required: true
            },
            shippingPeriods: {
                Object,
                required: true
            },

        },

        computed: {
            fullNameUser() {
                return this.user.first_name +' '+ this.user.last_name
            }
        },

        methods: {

            submit() {
                axios.post('/formato-informes-ssf/print', this.reportsSelected)
                    .then( (res) => {
                        console.log(res.data)
                    })
                    .catch( (err) => {

                    })
            },

            activeButtonAdd(){
                const select = document.getElementById('shipping_periods')
                if( parseInt(select.value) !== 0){
                    $('#buttonAdd').prop( 'disabled', false )
                }
            },

            addShippingPeriodsToSelect() {
                let select = document.getElementById('shipping_periods')
                while (select.hasChildNodes()){
                    select.removeChild(select.firstChild)
                }
                const selectReport = document.getElementById('reports')
                let reportSelected = this.reports.find( report => report.archivo === selectReport.value )
                let shippingPeriods = this.shippingPeriods.filter( shippingPeriod => shippingPeriod.code === parseInt(reportSelected.tipper) )
                shippingPeriods.map((shippingPeriod) => {
                    select.appendChild(new Option(`${shippingPeriod.name}`, shippingPeriod.id))
                })

            },

            addReportsToSelect() {
                let select = document.getElementById('reports');
                while (select.hasChildNodes()){
                    select.removeChild(select.firstChild)
                }
                this.reports.map((report) => {
                    select.appendChild(new Option(`${report.archivo} ${report.nombre}`, report.archivo))
                })
                this.addShippingPeriodsToSelect()
                $('#loading-pacman').modal('hide')
            },

            addReport() {
                const selectReport = document.getElementById('reports')
                let reportSelected = this.reports.find( report => report.archivo === selectReport.value )
                let periodicitySelected = this.periodicities.find( periodicity => periodicity.id === parseInt(reportSelected.tipper) )
                let signatures = this.signaturesType.find( signatureType => signatureType.id === parseInt(reportSelected.firma) )
                let shippingPeriodSelected = this.shippingPeriods.find( shippingPeriod => shippingPeriod.id === parseInt($('#shipping_periods').val()) )
                let selectCategory = document.getElementById('category_report')
                let categorySelected = this.categoryReports.find( category => category.id === parseInt(selectCategory.value))

                this.reportsSelected.push({
                    categorySelected,
                    reportSelected,
                    shippingPeriodSelected,
                    periodicitySelected,
                    signatures
                })

                this.isActiveBtn = true
            },

            removeReport(report) {
                const index = this.reportsSelected.indexOf(report);
                this.reportsSelected.splice(index, 1);
                console.log(this.reportsSelected.length)
                if(this.reportsSelected.length <= 0){
                    this.isActiveBtn = false
                }
            },

            getReports(event) {
                $('#loading-pacman').modal('show')
                let value = {id:event.target.value};
                axios.post('/formato-informes-ssf/getReports', value)
                    .then((res) => {
                        this.reports = res.data
                        this.addReportsToSelect()
                    })
                    .catch((err) => {
                        alert(err.message)
                    })
            }
        }
    }
</script>

<style scoped>

</style>