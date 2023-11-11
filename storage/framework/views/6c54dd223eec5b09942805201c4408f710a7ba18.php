 <div class="col-md-3">
     <div class="card mt-n5">
         <div class="card-body p-4">
             <div class="text-center">
                 <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                     <img src="<?php echo e(asset(Auth::user()->image)); ?>" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image">
                     <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                         <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                             <span class="avatar-title rounded-circle bg-light text-body">
                                 <i class="ri-camera-fill"></i>
                             </span>
                         </label>
                     </div>
                 </div>
                 <h5 class="fs-16 mb-1"><?php echo e(Auth::user()->name); ?></h5>
                 <p class="text-muted mb-0"><?php echo e(Auth::user()->phone); ?> / <?php echo e(Auth::user()->email); ?></p>
             </div>
         </div>
     </div>
 </div><?php /**PATH D:\xampp\htdocs\order.local\resources\views/user/backend/user/profile_sidebar.blade.php ENDPATH**/ ?>