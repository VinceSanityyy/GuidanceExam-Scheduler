<template>
  <div class="row">
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
    <br>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{pendingCount}}<sup style="font-size: 20px"></sup></h3>
                 <p>Pending Schedules</p>
            </div>
            <div class="icon">
              <i class="fa fa-book"></i>
            </div>
             <router-link to="/schedules" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></router-link>
            <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
          </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{pendingUsers}}</h3>
              <p>Pending Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
             <router-link to="/users" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></router-link>
            <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{users}}</h3>
                <p>Total Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-people-outline"></i>
            </div>
             <router-link to="/users" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></router-link>
            <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
          </div>
        </div>

      </div>
</template>

<script>
    export default {
      data(){
        return{
          pendingCount:'',
          pendingUsers:'',
          users:''
        }
      },
        created() {
            console.log('Component mounted.')
            this.countPending()
            this.countPendingUsers()
            this.countUsers()
            
        },
        methods:{
          countPending(){
            axios.get('/countPending')
              .then((res)=>{
                this.pendingCount = res.data
              })
          },
          countPendingUsers(){
             axios.get('/countPendingUsers')
              .then((res)=>{
                this.pendingUsers = res.data
              })
          },
          countUsers(){
             axios.get('/countUsers')
              .then((res)=>{
                this.users = res.data
              })
          }
        }
    }
</script>
