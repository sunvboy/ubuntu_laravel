@if(!empty($histories) && count($histories) > 0)
<!--end card-->
<div class="card">
    <div class="card-header">
        <div class="d-sm-flex align-items-center">
            <h5 class="card-title flex-grow-1 mb-0">Lịch sử chỉnh sửa</h5>
        </div>
    </div>
    <div class="card-body">
        <div class="profile-timeline">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                @foreach($histories as $item)
                <div class="accordion-item border-0">
                    <div class="accordion-header" id="heading{{$item->id}}">
                        <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapse{{$item->id}}" aria-expanded="true" aria-controls="collapse{{$item->id}}">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 avatar-xs">
                                    <div class="avatar-title bg-success rounded-circle">
                                        <i class="ri-shopping-bag-line"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="fs-15 mb-0 fw-semibold">{{!empty($item->user)?$item->user->name:''}} - <span class="fw-normal">{{$item->created_at}}</span></h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div id="collapse{{$item->id}}" class="accordion-collapse collapse show" aria-labelledby="heading{{$item->id}}" data-bs-parent="#accordionExample">
                        <div class="accordion-body ms-2 ps-5 pt-0">
                            <h6 class="mb-1">{!!$item->note!!}</h6>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
            <!--end accordion-->
        </div>
    </div>
</div>
@endif