<template>
    <header>
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <div class="container-fluid px-5">
                <RouterLink :to="{name:'Home'}" class="navbar-brand">CustomAds</RouterLink>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainnav">
                    <span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="mainnav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <RouterLink :to="{name:'Home'}" class="nav-link">Home</RouterLink>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
</template>

<script>
    export default {
        name: "Header"
    }
</script>

<style scoped>
    .nav-link
    {
        color: white !important;
    }
</style>
