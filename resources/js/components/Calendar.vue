<template>
   <div class="row">
      <div class="col-md-3">
         <div class="box box-success">
            <div class="box-header with-border">
               <h3 class="box-title">Add Event</h3>
               <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="remove"></button>
               </div>
            </div>
            <form>
            <div class="box-body">
               <div class="form-group">
                  <label>Type</label>
                  <select  v-model="form.type" class="form-control">
                     <option>Consultation</option>
                     <option>Examination - College Adjustment Scale</option>
                     <option>Examination - Standard Progressive Matrices</option>
                     <option>Examination - 16 Personality Factor Test</option>
                     <option>Examination - Beck's Depression Inventory</option>
                     <option>Examination - Filipino Work Values Scale</option>
                     <option>Examination - IQ Test</option>
                     <option>Examination - Basic Personality Inventory</option>
                     <option>Examination - BarOn Emotional Quotient Inventory</option>
                  </select>
               </div>
               <div class="form-group">
                  <label>Date:</label>
                  <div class="input-group date">
                     <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                     </div>
                    <date-picker name="date" id="date" v-model="form.date" :config="opt" ></date-picker>
                  </div>
               </div>
                   <div class="form-group">
                  <label>From:</label>
                  <div class="input-group date">
                     <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                     </div>
                    <date-picker name="from" id="from" v-model="form.from" :config="options" ></date-picker>
                  </div>
               </div>
                   <div class="form-group">
                  <label>To:</label>
                  <div class="input-group date">
                     <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                     </div>
                    <date-picker name="to" id="to" v-model="form.to" :config="options" ></date-picker>
                  </div>
               </div>
                <button type="button" class="btn btn-block btn-success" @click ="createSchedule()">Request Schedule</button>
            </div>
            </form>
         </div>
      </div>
      <div class="col-md-9">
         <div class="box box-success">
            <div class="box-header with-border">
            <h3 class="box-title">Calendar</h3>
            </div>
            <FullCalendar
      class='demo-app-calendar'
      ref="fullCalendar"
      defaultView="dayGridMonth"
      :header="{
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
      }"
      :plugins="calendarPlugins"
      :weekends="calendarWeekends"
      :events="calendarEvents"
      @dateClick="handleDateClick"
      @eventClick="handleEventClick"
      />
         </div>
      </div>
   </div>
</template>
<script>
   import FullCalendar from '@fullcalendar/vue'
   import dayGridPlugin from '@fullcalendar/daygrid'
   import interactionPlugin from '@fullcalendar/interaction'
   import timeGridPlugin from '@fullcalendar/timegrid'
   export default {
      components: {
         FullCalendar
      },
      data(){
         return{
            calendarPlugins: [
               dayGridPlugin,
               timeGridPlugin,
               interactionPlugin,
            ],
            calendarWeekends: true,
            handleWindowResize: true,
            calendarEvents: [ // initial event data
               
            ],

            form: new Form({
               date:'',
               type:'',
               from:'',
               to:''

            }),

            date: new Date(),
                    opt: {
                    format: 'YYYY-MM-DD',
                    showClear: true,
                    showClose: true,
            },

            from: new Date(),
                    options: {
                    format: 'HH:mm',
                    showClear: true,
                    showClose: true,
                    },
            to: new Date(),
                    options: {
                    format: 'HH:mm',
                    showClear: true,
                    showClose: true,
                    },
         }
      },
      methods:{
          createSchedule(){
            this.form.post('/addSchedule')
              .then(({data})=>{
                swal.fire("Schedule Created!", "", "success");
                
                this.form.reset()
                let classColor
                 let params = { date: this.date};
                if(data.schedule_type == 'Examination'){
                     classColor = 'examination'
                } else {
                     classColor = 'consultation'
                }
               //  this.calendarEvents.push({ // add new event
               //    id: data.id,
               //    title: data.schedule_type,
               //    date: data.start_date,
               //    start: data.start_date,
               //    end: data.end_date,
               //    className: classColor,
               //    allDay: false,
               //    timezone: 'local',
               // })
              })
          },
          getSchedules(){
             axios.post('/getSchedule')
               .then(({data})=>{
                  let classColor
                  data.forEach(res=>{
                     if(res.schedule_type == 'Examination'){ //set the class name of the schedule type. see css
                        classColor = 'examination'
                     } else {
                        classColor = 'consultation'
                     }
                     this.calendarEvents.push({ // set all the event 
                        id: res.id,
                        title: res.schedule_type,
                        start: res.start_date,
                        end: res.end_date,
                        className: classColor,
                        allDay: false,
                        timezone: 'local',
                     })
                  })
               })
          },
          handleDateClick(arg) { // click date
            alert('date clicked') 
         },
          handleEventClick(arg) { // click event
            console.log(arg.event.id) //get the id of the clicked event
         }
      },
       mounted() {
          this.getSchedules()
       }
   }
</script>
<style lang='scss'>
// you must include each plugins' css
// paths prefixed with ~ signify node_modules
@import '~@fullcalendar/core/main.css';
@import '~@fullcalendar/daygrid/main.css';
@import '~@fullcalendar/timegrid/main.css';
.demo-app {
  font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
  font-size: 14px;
}
.demo-app-top {
  margin: 0 0 3em;
}
.demo-app-calendar {
  margin: 0 auto;
  max-width: 900px;
}
.examination {
   background: red;
   color: #ffffff;
   border-color: red;
}
.consultation {
   background: green;
   color: #ffffff;
   border-color: green;
}
</style>