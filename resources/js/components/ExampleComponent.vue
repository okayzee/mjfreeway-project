<template>
    <div class="container">
        <div class="row justify-content-center" v-for="coffees in coffee" :key="coffees.id">

            <div class="col-md-4 card-space">
                <div class="card" style="width: 18rem;">
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ coffees.name }} - {{ coffees.serving }}mg</h5>
                        <p class="card-text">{{ coffees.description }}</p>
                        <a href="#" class="btn btn-primary">Buy</a>
                    </div>
                </div>
            </div>


        </div>
    </div>
</template>

<script>
    export default {
        name: "coffee",
        data() {
            return {
                coffee: {}
            };
        },
        async mounted() {
            console.log('Component mounted.')
            await this.getCoffee();
        },
        methods: {
            async getCoffee() {
                try {
                    const {
                        data: { data },
                    } = await axios.get(
                        `/api/coffee`
                    );
                    this.coffee = data;
                    console.log(data)
                } catch (e) {
                    console.log(e);
                }
            }
        },
    }
</script>

<style scoped>
    .card-space {
        margin-bottom: 20px;
    }
</style>
