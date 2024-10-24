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
            @php
                $averageStarCount = $book->reviews->avg('star_count');
                $fullStars = floor($averageStarCount); // 満点の数
                $halfStar = $averageStarCount - $fullStars >= 0.1; // 半点があるか
                $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0); // 残りの星
            @endphp
                {{-- 満点の星を表示 --}}
                @for ($i = 0; $i < $fullStars; $i++)
                <i class="fa-solid fa-star text-warning"></i>
                @endfor
                
            {{-- 半点の星を表示 --}}
            @if ($halfStar)
                <i class="fa-solid fa-star-half-stroke text-warning"></i>
                @endif
                
                {{-- 未満の星を表示 --}}
                @for ($i = 0; $i < $emptyStars; $i++)
                <i class="fa-regular fa-star text-warning"></i>
            @endfor

            {{ number_format($averageStarCount, 1) }}/5.0
          </h5>
          <div class="rating-summary">
            <div class="rating-details">
              <div class="rating-row">
                <span>5 star</span>
                <div class="bar">
                    <div class="fill" style="width: {{ number_format($ratingsSummary['5_star'],2) }}%;"></div>
                </div>
                <span>{{ number_format($ratingsSummary['5_star'],2) }}%</span>
            </div>
            <div class="rating-row">
                <span>4 star</span>
                <div class="bar">
                    <div class="fill" style="width: {{ number_format($ratingsSummary['4_star'],2) }}%;"></div>
                </div>
                <span>{{ number_format($ratingsSummary['4_star'],2) }}%</span>
            </div>
            <div class="rating-row">
                <span>3 star</span>
                <div class="bar">
                    <div class="fill" style="width: {{ number_format($ratingsSummary['3_star'],2) }}%;"></div>
                </div>
                <span>{{ number_format($ratingsSummary['3_star'],2) }}%</span>
            </div>
            <div class="rating-row">
                <span>2 star</span>
                <div class="bar">
                    <div class="fill" style="width: {{ number_format($ratingsSummary['2_star'],2) }}%;"></div>
                </div>
                <span>{{ number_format($ratingsSummary['2_star'],2) }}%</span>
            </div>
            <div class="rating-row">
                <span>1 star</span>
                <div class="bar">
                    <div class="fill" style="width: {{ number_format($ratingsSummary['1_star'],2) }}%;"></div>
                </div>
                <span>{{ number_format($ratingsSummary['1_star'],2) }}%</span>
            </div>
            </div>
            <div class="total-ratings">
                total global ratings
          </div>
        </div>
        
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            Close
        </button>
        </div>
      </div>
    </div>
  </div>



  

  


  
