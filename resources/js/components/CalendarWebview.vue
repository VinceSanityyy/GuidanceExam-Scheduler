<template>
   <div class="row">
      <div class="col-md-12">
         <div class="box box-success">
            <div class="box-header with-border">
            <!-- <h3 class="box-title">Calendar</h3> -->
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
//    import listPlugin from '@fullcalendar/list';
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
               
            //    listPlugin,
            ],
            calendarWeekends: true,
            handleWindowResize: false,
            allDaySlot: false,
            // start_time: '9:00',
            // end_time: '14:00',
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
                // let classColor
                 let params = { date: this.date};
                // if(data.schedule_type == 'Examination'){
                //      classColor = 'examination'
                // } else {
                //      classColor = 'consultation'
                // }
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
                //   let classColor
                  data.forEach(res=>{
                    //  if(res.schedule_type == 'Examination'){ //set the class name of the schedule type. see css
                    //     classColor = 'examination'
                    //  } else {
                    //     classColor = 'consultation'
                    //  }
                     this.calendarEvents.push({ // set all the event 
                        id: res.id,
                        title: "Slot taken",
                        start: res.start_date,
                        end: res.end_date,
                        // className: classColor,
                        allDay: false,
                        timezone: 'local',
                     })
                  })
               })
          },
          handleDateClick(arg) { // click date
            // alert('date clicked') 
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
