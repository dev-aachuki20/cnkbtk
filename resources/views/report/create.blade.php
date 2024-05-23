        
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="reportForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{trans("cruds.reports.title_singular")}}</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    <div class="modal-body">
                        <input type="hidden" name="poster_id" value="{{$id}}" id="poster_id" class="form-control" >
                        <div class="form-group  col-md-12">
                            <label>{{trans("cruds.reports.fields.reason")}}<span class="required">*</span></label>
                            <input type="text"  name="reason" value="" id="reason" class="form-control"  placeholder="{{trans("cruds.global.enter")}} {{trans("cruds.reports.fields.reason")}}">
                        </div>
                            <br>
                        <div class="form-group  col-md-12">
                            <label>{{trans("cruds.reports.fields.description")}}<span class="required">*</span></label>
                            <textarea name="description"  class="form-control" placeholder="{{trans("cruds.global.enter")}} {{trans("cruds.reports.fields.description")}}" id="description" ></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                        <button type="submit" class="btn btn-primary">{{trans("cruds.global.save")}}</button>
                    </div>
                </form>
            </div>
        </div>