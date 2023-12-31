 <div class="col-md-3">
     <div class="card mt-n5">
         <div class="card-body p-4">
             <div class="text-center">
                 <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                     <img src="{{asset(Auth::user()->image)}}" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image">
                     <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                         <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                             <span class="avatar-title rounded-circle bg-light text-body">
                                 <i class="ri-camera-fill"></i>
                             </span>
                         </label>
                     </div>
                 </div>
                 <h5 class="fs-16 mb-1">{{Auth::user()->name}}</h5>
                 <p class="text-muted mb-0">{{Auth::user()->phone}} / {{Auth::user()->email}}</p>
             </div>
         </div>
     </div>
 </div>