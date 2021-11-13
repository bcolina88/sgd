<template>
    <div>
        <li v-for="module in this.modules" class="with-sub">
            <a href="#" class="waves-effect  waves-light">
                <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                <span class="s-icon"><i class="ti-bar-chart-alt"></i></span>
                <span class="s-text">{{module.name}}</span>
                <ul style="display: none;">
                <li><a :href="'/nuevo/'+module.id">Crear nuevo archivo</a></li>
                <li><a :href="'/list/'+module.id">Archivos digitalizados</a></li>
            </ul>
            </a>
        </li>
    </div>
</template>
<script>
    export default {
        data(){
            return {
                modules : []
            }
        },
        methods : {
        },
        mounted(){
            axios.get("/api/getModules")
                .then(response => {
                this.modules = response.data
        })
        .catch(error => {
                console.log(error);
        });
        }
    }
</script>