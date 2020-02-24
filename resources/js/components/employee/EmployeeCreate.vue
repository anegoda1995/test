<template>
    <div class="ui container">
        <p>First name: <input v-model="employee.first_name"></p>
        <p>Middle name: <input v-model="employee.middle_name"></p>
        <p>Last name: <input v-model="employee.last_name"></p>
        <p>Employment date: <input v-model="employee.employment_date"></p>
        <p>Salary: <input v-model="employee.salary"></p>
        <button class="ui primary button" @click="doUpdate">Update</button>
    </div>
</template>

<script>
  export default {
    mounted() {
      let token = localStorage.getItem('default_auth_token');
      let employeeId = this.$route.params.employeeId;
      this.axios
      .put('/employee/' + employeeId, {
            headers: {
                Authorization: "Bearer " + token
            }
        })
      .then(response => {
        let employee = response.data.data;
        this.employee = employee;
      });
    },
    data () {
      return {
        employee: null,
      };
    },
    methods: {
      doUpdate () {
        let token = localStorage.getItem('default_auth_token');
        let employeeId = this.$route.params.employeeId;
        let employee = this.employee;
        this.axios
        .post('/employee/' + employeeId, {
              employee,
              headers: {
                  Authorization: "Bearer " + token
              }
          })
        .then(response => {
        });
      }
    }
  }
  </script>