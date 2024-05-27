<!-- Finish Project Modal -->
<div class="modal fade" id="finishProjectRatingModal" tabindex="-1" aria-labelledby="finishProjectRatingModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="finishProjectRatingForm" action="{{ route('finish.project') }}" method="POST">
                @csrf
                <input type="hidden" name="project_id" id="project_ids" value="">
                <div class="modal-header">
                    <h5 class="modal-title" id="finishProjectRatingModalLabel">{{ trans('cruds.finished_project.options.add_remark') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="remark" class="form-label w-100">{{__('cruds.global.rating')}}<span class="text-danger">*</span></label>
                        <div class="ratingWrapper">
                        <input type="hidden" name="star_rating" id="star_rating" value="" >
                        <div class="rating" role="radiogroup" id="starRatings" aria-labelledby="rating">
                            <input type="radio" id="star5" name="star_rating" value="5" /><label for="star5" aria-label="5 stars" class="mb-1"></label>
                            <input type="radio" id="star4" name="star_rating" value="4" /><label for="star4" aria-label="4 stars" class="mb-1"></label>
                            <input type="radio" id="star3" name="star_rating" value="3" /><label for="star3" aria-label="3 stars" class="mb-1"></label>
                            <input type="radio" id="star2" name="star_rating" value="2" /><label for="star2" aria-label="2 stars" class="mb-1"></label>
                            <input type="radio" id="star1" name="star_rating" value="1" /><label for="star1" aria-label="1 star" class="mb-1 star_one"></label>
                        </div>

                    </div>
                    <div class="mb-3">
                        <label for="remark" class="form-label">{{ trans('cruds.finished_project.fields.remark') }}</label>
                        <textarea class="form-control" id="remark" name="remark" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ trans('cruds.global.close') }}</button> --}}
                    <button type="submit" class="btn btn-primary">{{ trans('cruds.global.submit') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>