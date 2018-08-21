<template>

</template>
<script>
    Vue.component('geocode-component', {
        data: function () {
            return {
                current: "",
                option: [],
            };
        },
        computed: {
            data() {
                const response = async () => {
                    const response = await fetch(`/index.php?query=${this.current}`, {cache: "no-cache"});
                    this.option = await response.json();
                };

                response();
            }
        },
        template: `
            <div class="select">
                <input v-model="current">
                <span style="display: none">{{data}}</span>
                <select size="6">
                    <option v-for="el in option" v-on:click="current = el">{{el}}</option>
                </select>
            </div>
            `,
    });

    new Vue({el: '#geocode'});
</script>
<style>
    .select {
        display: flex;
        flex-direction: column;
    }
</style>