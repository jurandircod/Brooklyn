     @section('produto-descricao')
         <div class="col-12">
             <div class="cloth-review">
                 <nav>
                     <div class="nav nav-tabs" id="nav-tab" role="tablist">
                         <button class="nav-link" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#desc"
                             type="button">Descrição</button>

                         <button class="nav-link" id="nav-size-tab" data-bs-toggle="tab" data-bs-target="#nav-guide"
                             type="button">Tamanhos</button>

                         <button class="nav-link active" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#review"
                             type="button">Avaliação</button>
                     </div>
                 </nav>

                 <div class="tab-content" id="nav-tabContent">
                     <div class="tab-pane fade" id="desc">
                         <div class="shipping-chart">
                             <div class="part">
                                 <h4 class="inner-title mb-2">{{ $produto->nome }}</h4>
                                 <p class="font-light">{{ $produto->descricao }}</p>
                             </div>
                         </div>
                     </div>



                     <div class="tab-pane fade overflow-auto" id="nav-guide">
                         <div class="table-responsive">
                             <table class="table table-pane mb-0">
                                 <tbody>
                                     <tr class="bg-color">
                                         <th class="my-2">Tamanhos dos skates</th>
                                         <td></td>
                                         <td>7.75</td>
                                         <td>8</td>
                                         <td>8.25</td>
                                         <td>8.5</td>
                                     </tr>
                                 </tbody>
                             </table>
                         </div>
                     </div>



                     <div class="tab-pane fade show active" id="review">
                         <div class="row g-4">
                             <div class="col-lg-4">
                                 <div class="customer-rating">
                                     <h2>Faça sua avaliação</h2>


                                     <div class="global-rating">
                                         <h5 class="font-light">{{ $produto->avaliacao->count() }} Avaliações</h5>
                                     </div>
                                 </div>
                             </div>

                             <div class="col-lg-8">

                                 <div class="review-box">
                                     <form class="row g-4" action="{{ route('site.produto.avaliacao') }}" method="POST">
                                         @csrf

                                         <input type="hidden" name="produto_id" value="{{ $produto->id }}">

                                         <p class="d-inline-block me-2">Avaliação</p>
                                         <ul class="rating mb-3 d-inline-block" id="rating">
                                             <li data-value="1">
                                                 <i class="fas fa-star"></i>
                                             </li>
                                             <li data-value="2">
                                                 <i class="fas fa-star"></i>
                                             </li>
                                             <li data-value="3">
                                                 <i class="fas fa-star"></i>
                                             </li>
                                             <li data-value="4">
                                                 <i class="fas fa-star"></i>
                                             </li>
                                             <li data-value="5">
                                                 <i class="fas fa-star"></i>
                                             </li>
                                         </ul>
                                         <input type="hidden" name="estrela" id="avaliacaoInput" value="0">

                                         <div class="col-12">
                                             <label class="mb-1" for="comentario">Comentario</label>
                                             <textarea class="form-control" placeholder="Leave a comment here" id="comments" name="comentario" style="height: 100px"
                                                 required=""></textarea>
                                         </div>

                                         <div class="col-12">
                                             <button type="submit" class="btn btn-solid-default text-white">Enviar
                                                 Comentario</button>
                                         </div>
                                     </form>
                                     <style>
                                         .rating i.active {
                                             color: gold;
                                             /* ou qualquer cor que desejar para estrelas selecionadas */
                                         }
                                     </style>
                                 </div>
                             </div>
                             <div class="col-12 mt-4">
                                 <div class="customer-review-box">
                                     <h4>Comentários</h4>
                                     <div id="avaliacoes-container">
                                         @include('site.layouts._pages.produtos.avaliacoes', [
                                             'avaliacoes' => $avaliacoes,
                                         ])
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     @endsection
