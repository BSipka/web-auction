<template>
    <div>
       <a href="offers"> Offers   {{this.offer_count}}</a>
         <br>
        <a> My Bids   {{this.bid_count}} </a>
    </div>
</template>
<script>
    export default {
        data(){
            return{
               offer_count:'',
               bid_count:''
            }
        },
        created(){
            this.fetchNotifications()
        },

        methods:{
           fetchNotifications(){
                fetch("offers.count")
                .then(res=>res.json())
                .then(data=> {
                    this.offer_count =data.offer_count,
                    this.bid_count =data.bid_count
                    });
            }
        }
    }
</script>
