    
<!-- Subscribe Modal -->
@if($notificationImage)
  <div class="modal fade" id="modal-subscribe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <button type="button" class="btn-close modal-close-icon" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="modal-body">
          <a href="{{$notificationImage->url}}">
            <img src="{{$popouImage}}">
          </a>
        </div>
      </div>
    </div>
  </div>
  @endif
  <!-- end subscribe modal -->