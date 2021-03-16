<template>
    <div>
        <ul class="list-group  mt-3">
            <li class="list-group-item text-light bg-dark">{{this.name}}</li>
            <li class="list-group-item text-light bg-dark">{{this.email}}</li>
            <li class="list-group-item text-light bg-dark">{{this.first_name}}</li>
            <li class="list-group-item text-light bg-dark">{{this.middle_name}}</li>
            <li class="list-group-item text-light bg-dark">{{this.last_name}}</li>
            <li class="list-group-item text-light bg-dark">{{this.city}}</li>
            <li class="list-group-item text-light bg-dark">{{this.balance}}</li>
        </ul>
        
    </div>
</template>
<script>
    export default {
        data(){
            return{
               name : '',
               email : '',
               first_name:'',
               middle_name:'',
               last_name:'',
               city:'',
               balance:''
            }
        },
        created(){
            this.fetchUsersDetails()
        },

        methods:{
           fetchUsersDetails(){
                fetch("users.details")
                .then(res=>res.json())
                .then(data=> {
                    this.name =data.name,
                    this.email =data.email,
                    this.first_name =data.first_name,
                    this.middle_name =data.middle_name,
                    this.last_name =data.last_name,
                    this.city =data.city,
                    this.balance =data.balance
                    
                    });
            }
        }
    }
</script>
