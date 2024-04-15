
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="purchaseForm">
                     <input name="episode_id" type="hidden" value="{{Crypt::encrypt($episode->id)}}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{trans("pages.poster.episode_details")}}</h5>
                        <button type="button" class="btn-close closePurchaseForm" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="product-pay-details">
                            <div class="product-inner ">
                            <div class="product-box mb-2">
                                <div class="product-name">
                                    <h3> {{trans("pages.post.form.fields.episode_title")}}    : <span>{{$episode->title}}</span></h3>
                                </div> 
                            </div>
                            <div class="order-box product-name">
                                <h3>
                                    {{trans("pages.selftopup.points")}} : <span>{{$episode->cost}}</span>
                                </h3>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{trans("cruds.global.purchase")}}</button>
                    </div>
                </form>
            </div>
        </div>