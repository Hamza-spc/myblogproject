<!DOCTYPE html>
<html lang="en">
   <head>
      <style type="text/css">
         .div_deg {
            text-align: center;
         }
         .title_deg {
            font-size: 30px;
            font-weight: bold;
            color: white;
            padding: 30px;
         }
         label {
            display: inline-block;
            width: 200px;
            color: white;
            font-size: 18px;
            font-weight: bold;
         }
         .field_deg {
            padding: 15px; /* Reduced padding */
         }
         input[type="text"],
         textarea,
         input[type="file"] {
            width: 300px;
            padding: 10px;
            margin-top: 10px;
         }
         .btn {
            margin-top: 15px;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
         }
         .btn:hover {
            background-color: #0056b3;
         }
      </style>
      @include('home.homecss');
   </head>
   <body>
    @include('sweetalert::alert')
      <!-- header section start -->
      <div class="header_section">
         @include('home.header')

         <div class="div_deg">
            <h3 class="title_deg">Add Post</h3>
            <form action="{{url('user_post')}}" method="POST" enctype="multipart/form-data">
               @csrf
               <div class="field_deg">
                  <label for="">Title</label>
                  <input type="text" name="title" id="">
               </div>
               <div class="field_deg">
                  <label for="">Description</label>
                  <textarea name="description" id="" cols="30" rows="10"></textarea>
               </div>
               <div class="field_deg">
                  <label for="">Add image</label>
                  <input type="file" name="image" id="">
               </div>
               <div class="field_deg">
                  <input type="submit" value="Add Post" class="btn">
               </div>
            </form>
         </div>

         @include('home.footer')
      </div>
   </body>
</html>
