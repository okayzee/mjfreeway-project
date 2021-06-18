<template>
    <div class="container">
        <div class="row justify-content-center" >

            <div class="col-md-4 card-space" v-for="coffees in coffee" :key="coffees.id">
                <div class="card" style="width: 18rem;">
                    <img :src="coffees.image" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ coffees.name }} - {{ coffees.serving }}mg</h5>
                        <p class="card-text">{{ coffees.description }}</p>
                        <button type="button" class="btn btn-primary"
                                data-bs-toggle="modal" v-on:click="setId(coffees.id)" data-bs-target="#exampleModal">Buy</button>
                    </div>
                </div>
            </div>

        </div>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="orderCoffee">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Quantity</label>
                                <input
                                    v-model="coffee.quantity"
                                    type="number"
                                    name="quantity"
                                    class="form-control" placeholder="Quantity in mg"
                                    id="exampleInputEmail1" aria-describedby="emailHelp" />
                                <p v-if="errors.quantity" class="text-xs mt-1 text-red-600">
                                    {{ errors.quantity[0] }}
                                </p>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    <div class="modal-footer" v-if="processedCoffee">
                        <ul>
                            <li>Coffee Name: {{ processedCoffee.name }}</li>
                            <li>You have consumed {{ processedCoffee.consumable }} oz and can still consume {{ processedCoffee.left_over }} mg left over</li>
                        </ul>
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
                form: {},
                coffee: {},
                errors: {},
                processedCoffee: null,
                currentId: ''
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
            },

            async orderCoffee(evt) {
                this.errors = {};
                const form = new FormData(evt.target);
                try {
                    const {
                        data: { data },
                    } = await axios.post(`/api/coffee/order/${this.currentId}`, form);
                    console.log(data)
                    this.processedCoffee = data;
                } catch(error) {
                    console.log(error);
                    this.errors = error.response.data.error;
                }
            },

            async setId(id) {
                this.currentId = id;
            },
        },
    }
</script>

<style scoped>
    .card-space {
        margin-bottom: 20px;
    }
</style>
