<template>
    <header>
           <nav class="navbar navbar-expand-lg navbar-light bg-primary">
                <div class="container-fluid">
                     <!-- php -->
                    <router-link :to="{name: 'home'}" class="navbar-brand">
                        Boolpress
                    </router-link>
                    <a  href="#"></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item" v-for="(link,index) in menuBoolpress" :key="index">
                                <router-link :to="{ name: link.routeName}" class="nav-link">
                                    {{ link.label }}
                                </router-link>
                            </li>
                            <!-- :to mi guarda la rotta dove il nome è about -->

                        </ul>
                    </div>
                </div>
            </nav>
        </header>
</template>

<script>
export default {
    name: "Header",
    data() {
        return {
            menuBoolpress: [
                {
                    label: 'Home',
                    routeName: 'home' 
                },
                {
                    label: 'Chi siamo',
                    routeName: 'about'
                },
                {
                    label: 'My Posts',
                    routeName: 'post'
                },
                {
                    label: 'Contatti',
                    routeName: 'contact'
                }
            ]
        }
    }
}
</script>

<style lang="scss" scoped>
</style>