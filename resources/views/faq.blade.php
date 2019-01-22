@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="heading" id="qwe" style="margin-bottom: 70px; margin-top: 70px">FAQ</h2>
    <div id="accordion" class="accordion" style="margin-bottom: 70px;">

        <div class="card" style="border: 0px;">
            <div class="card-header" id="headingOne" style="border-bottom: 0px;">
                <h5 class="mb-0">
                    <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        <span class="accordion-name color-r" style="margin-left: -20px;"><b>Q:</b> Lorem ipsum dolor sit amet?</span>
                        <i class="fas fa-chevron-down color-r"></i>
                        <i class="fas fa-chevron-up color-r"></i>
                    </button>
                </h5>
            </div>

            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime aut, inventore provident laudantium modi distinctio consequatur assumenda, ea nam quo enim consequuntur beatae minima dolore omnis obcaecati ipsum officia quaerat.   
                </div>
            </div>
        </div>

        <div class="card" style="border: 0px;">
            <div class="card-header" id="headingTwo" style="border-bottom: 0px;">
                <h5 class="mb-0">
                    <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <span class="accordion-name color-r" style="margin-left: -20px;"><b>Q:</b> Lorem ipsum dolor sit amet?</span>
                        <i class="fas fa-chevron-down color-r"></i>
                        <i class="fas fa-chevron-up color-r"></i>
                    </button>
                </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                <div class="card-body">
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quia, doloremque nostrum? Nihil quos quis ad quas adipisci ipsum ut eveniet alias? Laborum totam necessitatibus asperiores quia adipisci modi velit in.
                </div>
            </div>
        </div>

        <div class="card" style="border: 0px;">
            <div class="card-header" id="headingThree" style="border-bottom: 0px;">
                <h5 class="mb-0">
                    <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        <span class="accordion-name color-r" style="margin-left: -20px;"><b>Q:</b> Lorem ipsum dolor sit amet?</span>
                        <i class="fas fa-chevron-down color-r"></i>
                        <i class="fas fa-chevron-up color-r"></i>
                    </button>
                </h5>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                <div class="card-body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque iusto alias non culpa molestiae sed? Odit, excepturi officia. Itaque ad velit debitis ducimus est eveniet ab, labore quos tempora at. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus ducimus consequuntur soluta libero, asperiores eligendi repellat odio quis debitis consequatur repudiandae excepturi obcaecati, hic, ad enim magnam commodi. Sapiente, illo?
                </div>
            </div>
        </div>

        <div class="card" style="border: 0px;">
            <div class="card-header" id="headingFour" style="border-bottom: 0px;">
                <h5 class="mb-0">
                    <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
                        <span class="accordion-name color-r" style="margin-left: -20px;"><b>Q:</b> Lorem ipsum dolor sit amet?</span>
                        <i class="fas fa-chevron-down color-r"></i>
                        <i class="fas fa-chevron-up color-r"></i>
                    </button>
                </h5>
            </div>
            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                <div class="card-body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque iusto alias non culpa molestiae sed? Odit, excepturi officia. Itaque ad velit debitis ducimus est eveniet ab, labore quos tempora at.
                </div>
            </div>
        </div>

        <div class="card" style="border: 0px;">
            <div class="card-header" id="headingFive" style="border-bottom: 0px;">
                <h5 class="mb-0">
                    <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseThree">
                        <span class="accordion-name color-r" style="margin-left: -20px;"><b>Q:</b> Lorem ipsum dolor sit amet?</span>
                        <i class="fas fa-chevron-down color-r"></i>
                        <i class="fas fa-chevron-up color-r"></i>
                    </button>
                </h5>
            </div>
            <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                <div class="card-body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque iusto alias non culpa molestiae sed? Odit, excepturi officia. Itaque ad velit debitis ducimus est eveniet ab, labore quos tempora at. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Similique voluptatem facere ducimus dolore. Sunt consequuntur, fugit sed error non odio minima quaerat expedita quod quos aliquam sit consectetur itaque voluptatem!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
