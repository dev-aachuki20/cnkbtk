<div class="modal fade" id="addBidModal" tabindex="-1" aria-labelledby="addBidModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBidModalLabel">{{__('cruds.create_project.headings.add_bid')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- form start -->
            <form action="{{route('user.add.project.bid')}}" method="post" id="addBidForm">
                <div class="modal-body">
                    <input type="hidden" id="auth_id" value="">
                    <input type="hidden" id="project_id" value="">
                    <input type="hidden" id="user_id" value="">
                    <div class="mb-4">
                        <div class="form-group">
                            <label for="budget">{{__('cruds.create_project.fields.budget')}}<span class="text-danger">*</span></label>
                            <input type="number" value="" class="form-control" name="bid" id="budget" placeholder="{{trans("global.enter")}} {{__('cruds.create_project.fields.budget')}}" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('cruds.global.cancel')}}</button>
                    <button type="submit" class="btn btn-primary">{{__('cruds.global.save')}}</button>
                </div>
            </form>
            <!-- form end -->
        </div>
    </div>
</div>