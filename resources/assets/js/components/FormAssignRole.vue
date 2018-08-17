<template>
    <div class="row">
        <table class="table table-hover table-bordered text-center">
            <thead class="thead-light">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nombre usuario</th>
                <th scope="col">Estado</th>
                <th scope="col">Rol actual</th>
                <th scope="col">Acciones</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="user in users">
                <th scope="row">{{ user.id }}</th>
                <td>{{ user.first_name }} {{ user.last_name }}</td>
                <td>{{ user.status.name }}</td>
                <td>
                    <span v-if="user.roles.length > 0" v-for="rol in user.roles"> {{ rol.name }}</span>
                    <span v-if="user.roles.length === 0">No hay roles asignados</span>
                </td>
                <td>
                    <form action="#" class="form-inline">
                        <select class="form-control" :name="`rol-${user.id}`" :id="`rol-${user.id}`">
                            <option value="0" selected disabled>Selecionar rol</option>
                            <option v-for="rol in roles" :value="rol.name">{{ rol.name }}</option>
                        </select>
                        <button type="button" v-if="user.roles.length === 0" @click="save_assign_role(`rol-${user.id}`,user.id)" class="btn btn-info ml-2"><i class="fa fa-plus-square fa-fw"></i> Asignar</button>
                        <button type="button" v-if="user.roles.length > 0" @click="change_role(`rol-${user.id}`,user.id)" class="btn btn-warning ml-2"><i class="fa fa-edit fa-fw"></i> Cambiar rol</button>
                    </form>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: "FormAssignRole",

        props: {
            users: {
                Object,
                required: true
            },
            roles: {
                Object,
                required: true
            }
        },

        methods: {

            validate_assign_rol(rol,idUser){
                const user = this.users.find(user => user.id === idUser)
                const userRoleAssigned = user.roles.find(userRol => userRol.name === rol)
                return userRoleAssigned === undefined
            },

            save_assign_role(idRoleSelect,idUser) {
                const rol = document.getElementById(idRoleSelect)
                if(this.validate_assign_rol(rol.value,idUser)) {
                    let data = {idUser,rol:rol.value}
                    swal({
                        type: 'info',
                        title: 'Cargando...',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        onOpen: () => {
                            swal.showLoading()
                            return axios.post('/roles/save-assign-role', data)
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
                                    swal({
                                        type: 'error',
                                        text: err.response.data.message
                                    })
                                })
                        }

                    })
                }else {
                    swal({
                        type: 'error',
                        text: 'El usuario ya tiene el rol asignado'
                    })
                }

            },

            change_role(idRoleSelect,idUser) {
                const rol = document.getElementById(idRoleSelect)
                if(this.validate_assign_rol(rol.value,idUser)){
                    let data = {idUser,rol:rol.value}
                    swal({
                        type: 'info',
                        title: 'Cargando...',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        onOpen: () => {
                            swal.showLoading()
                            return axios.post('/roles/change-role', data)
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
                                    swal({
                                        type: 'error',
                                        text: err.response.data.message
                                    })
                                })
                        }

                    })
                }else{
                    swal({
                        type: 'error',
                        text: 'El usuario ya tiene el rol asignado'
                    })
                }
            },

        }


    }
</script>

<style scoped>

</style>