<template>
    <div class="container-fluid animated fadeIn">
        <div class="jumbotron mb-2">
            <h1 class="display-3"
                v-t="'welcome'"></h1>

            <p v-t="'hints.admin-dashboard'"></p>

            <p class="lead">
                <a class="btn btn-primary" href="/admin/logout" role="button" v-t="'log-out'"></a>
            </p>
        </div>

        <dashboard-stats/>
    </div>
</template>

<script>
    import DashboardStats from './DashboardStats';

    export default {
        name: 'Dashboard',
        components: {
            DashboardStats
        }
    }
</script>

<style>
    .jumbotron,
    .dashboard-stats {
        background-color: #fff;
        box-shadow: 0 3px 4px -2px rgba(0, 0, 0, 0.1), 0 2px 2px 0 rgba(0, 0, 0, 0.08), 0 1px 8px 0 rgba(0, 0, 0, 0.08);
    }
</style>
