<template>
    <div>
        <ul>
            <li>{{this.name}}</li>
            <li>{{this.email}}</li>
            <li>{{this.first_name}}</li>
            <li>{{this.middle_name}}</li>
            <li>{{this.last_name}}</li>
            <li>{{this.city}}</li>
            <li>{{this.balance}}</li>
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
