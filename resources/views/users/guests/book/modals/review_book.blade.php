  <!-- jQuery（必要な場合） -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Popper.js（Bootstrapの依存関係） -->
{{-- <script src="https://cdn.jsdelivr.net/npm//core@2.11.6/dist/umd/popper.min.js"></script> --}}

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>




  
  <!-- Modal -->
  <div class="modal fade" id="reviewBook" tabindex="-1" role="dialog" aria-labelledby="reviewBookTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <h5 class="modal-title d-flex" id="reviewBookTitle">
            <div class="star-ration ms-2">
              <span class="star" data-value="1"><i class="fa-regular fa-star"></i></span>
              <span class="star" data-value="2"><i class="fa-regular fa-star"></i></span>
              <span class="star" data-value="3"><i class="fa-regular fa-star"></i></span>
              <span class="star" data-value="4"><i class="fa-regular fa-star"></i></span>
              <span class="star" data-value="5"><i class="fa-regular fa-star"></i></span>
            </div>
            <div class="ms-2">X.X/5.0</div>
          </h5>
          <div class="rating-summary">
            <div class="rating-details">
              <div class="rating-row">
                <span>5 star</span>
                <div class="bar">
                    <div class="fill" style="width: 54%;"></div>
                </div>
                <span>54%</span>
            </div>
            <div class="rating-row">
                <span>4 star</span>
                <div class="bar">
                    <div class="fill" style="width: 19%;"></div>
                </div>
                <span>19%</span>
            </div>
            <div class="rating-row">
                <span>3 star</span>
                <div class="bar">
                    <div class="fill" style="width: 15%;"></div>
                </div>
                <span>15%</span>
            </div>
            <div class="rating-row">
                <span>2 star</span>
                <div class="bar">
                    <div class="fill" style="width: 10%;"></div>
                </div>
                <span>10%</span>
            </div>
            <div class="rating-row">
                <span>1 star</span>
                <div class="bar">
                    <div class="fill" style="width: 2%;"></div>
                </div>
                <span>2%</span>
            </div>
            </div>
            <div class="total-ratings">
                total global ratings
            </div>
        </div>
        
        </div>
        <div class="modal-footer border-0">
          <a href="{{route('book.show_book', $book->id)}}">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </a>
        </div>
      </div>
    </div>
  </div>



  

  


  
