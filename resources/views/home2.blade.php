@extends('layouts.appcrateradmin')


@section('content')
<div data-v-68eb71ca="" class="customer-create main-content">
    <div class="page-header">
       <h3 class="page-title">Customers</h3>
       <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/admin/dashboard" class="" slot="item-title">
             Home
             </a>
          </li>
          <li class="breadcrumb-item"><a href="/admin/customers#" class="" slot="item-title">
             Customers
             </a>
          </li>
       </ol>
       <div class="page-actions row">
          <div class="col-xs-2 mr-4">
             <button type="button" class="base-button btn btn-outline-primary btn-lg ">
                <!----> <!----> 
                Filter
                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="filter" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="vue-icon icon-right svg-inline--fa fa-filter fa-w-16 ml-2">
                   <path fill="currentColor" d="M487.976 0H24.028C2.71 0-8.047 25.866 7.058 40.971L192 225.941V432c0 7.831 3.821 15.17 10.237 19.662l80 55.98C298.02 518.69 320 507.493 320 487.98V225.941l184.947-184.97C520.021 25.896 509.338 0 487.976 0z" class=""></path>
                </svg>
             </button>
          </div>
          <a href="/admin/customers/create" class="col-xs-2" slot="item-title">
             <button type="button" class="base-button btn btn-primary btn-lg ">
                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="vue-icon icon-left svg-inline--fa fa-plus fa-w-14 mr-2">
                   <path fill="currentColor" d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z" class=""></path>
                </svg>
                <!----> 
                New Customer
                <!---->
             </button>
          </a>
       </div>
    </div>
    <div class="filter-section" style="display: none;">
       <div class="row">
          <div class="col-sm-4">
             <label class="form-label">Display Name</label> 
             <div class="base-input">
                <!----> <input name="name" tabindex="" placeholder="" autocomplete="off" type="text" class="input-field"> <!----> <!---->
             </div>
          </div>
          <div class="col-sm-4">
             <label class="form-label">Contact Name</label> 
             <div class="base-input">
                <!----> <input name="address_name" tabindex="" placeholder="" autocomplete="off" type="text" class="input-field"> <!----> <!---->
             </div>
          </div>
          <div class="col-sm-4">
             <label class="form-label">Phone</label> 
             <div class="base-input">
                <!----> <input name="phone" tabindex="" placeholder="" autocomplete="off" type="text" class="input-field"> <!----> <!---->
             </div>
          </div>
          <label class="clear-filter">Clear All</label>
       </div>
    </div>
    <div align="center" class="col-xs-1 no-data-info" style="display: none;">
       <svg width="125" height="110" viewBox="0 0 125 110" fill="none" xmlns="http://www.w3.org/2000/svg" class="mt-5 mb-4">
          <g clip-path="url(#clip0)">
             <path fill-rule="evenodd" clip-rule="evenodd" d="M46.8031 84.4643C46.8031 88.8034 43.3104 92.3215 39.0026 92.3215C34.6948 92.3215 31.2021 88.8034 31.2021 84.4643C31.2021 80.1252 34.6948 76.6072 39.0026 76.6072C43.3104 76.6072 46.8031 80.1252 46.8031 84.4643Z" fill="#817AE3"></path>
             <path fill-rule="evenodd" clip-rule="evenodd" d="M60.4536 110H64.3539V72.6785H60.4536V110Z" fill="#55547A"></path>
             <path fill-rule="evenodd" clip-rule="evenodd" d="M85.8055 76.6072H70.2045C69.1319 76.6072 68.2544 77.4911 68.2544 78.5715V82.5C68.2544 83.5804 69.1319 84.4643 70.2045 84.4643H85.8055C86.878 84.4643 87.7556 83.5804 87.7556 82.5V78.5715C87.7556 77.4911 86.878 76.6072 85.8055 76.6072ZM70.2045 82.5H85.8055V78.5715H70.2045V82.5Z" fill="#817AE3"></path>
             <path fill-rule="evenodd" clip-rule="evenodd" d="M91.6556 1.96429C94.8811 1.96429 97.506 4.60821 97.506 7.85714V19.6429H83.8181L85.308 21.6071H99.4561V7.85714C99.4561 3.53571 95.9459 0 91.6556 0H33.152C28.8618 0 25.3516 3.53571 25.3516 7.85714V21.6071H39.3203L40.8745 19.6429H27.3017V7.85714C27.3017 4.60821 29.9265 1.96429 33.152 1.96429H91.6556Z" fill="#55547A"></path>
             <path fill-rule="evenodd" clip-rule="evenodd" d="M122.858 92.3213H117.007C115.935 92.3213 115.057 93.2052 115.057 94.2856V102.143C115.057 103.223 115.935 104.107 117.007 104.107H122.858C123.93 104.107 124.808 103.223 124.808 102.143V94.2856C124.808 93.2052 123.93 92.3213 122.858 92.3213ZM117.007 102.143H122.858V94.2856H117.007V102.143Z" fill="#817AE3"></path>
             <path fill-rule="evenodd" clip-rule="evenodd" d="M103.356 43.2142V70.7142H21.4511V43.2142H26.1821V41.2498H19.501V72.6783H105.306V41.2498H98.3541L98.2839 43.2142H103.356Z" fill="#55547A"></path>
             <path fill-rule="evenodd" clip-rule="evenodd" d="M101.406 21.6071C104.632 21.6071 107.257 24.251 107.257 27.5V41.25H98.2257L98.0853 43.2142H109.207V27.5C109.207 23.1609 105.714 19.6428 101.406 19.6428H83.8182L85.0878 21.6071H101.406ZM40.8746 19.6428H23.4016C19.0937 19.6428 15.6011 23.1609 15.6011 27.5V43.2142H26.1961L26.3365 41.25H17.5512V27.5C17.5512 24.251 20.1761 21.6071 23.4016 21.6071H39.3204L40.8746 19.6428Z" fill="#55547A"></path>
             <path fill-rule="evenodd" clip-rule="evenodd" d="M62.4041 9.82153C45.1709 9.82153 31.2021 23.8917 31.2021 41.2501C31.2021 58.6085 45.1709 72.6787 62.4041 72.6787C79.6373 72.6787 93.606 58.6085 93.606 41.2501C93.606 23.8917 79.6373 9.82153 62.4041 9.82153ZM62.4041 11.7858C78.5335 11.7858 91.6559 25.0035 91.6559 41.2501C91.6559 57.4967 78.5335 70.7144 62.4041 70.7144C46.2746 70.7144 33.1523 57.4967 33.1523 41.2501C33.1523 25.0035 46.2746 11.7858 62.4041 11.7858Z" fill="#55547A"></path>
             <path fill-rule="evenodd" clip-rule="evenodd" d="M62.4041 19.6428C45.1709 19.6428 31.2021 23.8916 31.2021 41.25C31.2021 58.6084 45.1709 66.7857 62.4041 66.7857C79.6373 66.7857 93.606 58.6084 93.606 41.25C93.606 23.8916 79.6373 19.6428 62.4041 19.6428ZM62.4041 21.6071C82.6346 21.6071 91.6559 27.665 91.6559 41.25C91.6559 56.0096 80.7216 64.8214 62.4041 64.8214C44.0866 64.8214 33.1523 56.0096 33.1523 41.25C33.1523 27.665 42.1735 21.6071 62.4041 21.6071Z" fill="#55547A"></path>
             <path fill-rule="evenodd" clip-rule="evenodd" d="M101.406 70.7144H23.4014C10.478 70.7144 0 81.2685 0 94.2858V110H124.808V94.2858C124.808 81.2685 114.33 70.7144 101.406 70.7144ZM101.406 72.6786C113.234 72.6786 122.858 82.3724 122.858 94.2858V108.036H1.95012V94.2858C1.95012 82.3724 11.574 72.6786 23.4014 72.6786H101.406Z" fill="#55547A"></path>
             <path fill-rule="evenodd" clip-rule="evenodd" d="M33.152 33.3928H29.2518C27.0969 33.3928 25.3516 35.1509 25.3516 37.3214V45.1785C25.3516 47.3491 27.0969 49.1071 29.2518 49.1071H33.152V33.3928ZM31.2019 35.3571V47.1428H29.2518C28.1773 47.1428 27.3017 46.2609 27.3017 45.1785V37.3214C27.3017 36.2391 28.1773 35.3571 29.2518 35.3571H31.2019Z" fill="#55547A"></path>
             <path fill-rule="evenodd" clip-rule="evenodd" d="M95.556 33.3928H91.6558V49.1071H95.556C97.7109 49.1071 99.4562 47.3491 99.4562 45.1785V37.3214C99.4562 35.1509 97.7109 33.3928 95.556 33.3928ZM95.556 35.3571C96.6305 35.3571 97.5061 36.2391 97.5061 37.3214V45.1785C97.5061 46.2609 96.6305 47.1428 95.556 47.1428H93.6059V35.3571H95.556Z" fill="#55547A"></path>
             <path fill-rule="evenodd" clip-rule="evenodd" d="M94.581 15.7144C94.0447 15.7144 93.606 16.1563 93.606 16.6965V34.3751C93.606 34.9152 94.0447 35.3572 94.581 35.3572C95.1173 35.3572 95.5561 34.9152 95.5561 34.3751V16.6965C95.5561 16.1563 95.1173 15.7144 94.581 15.7144Z" fill="#55547A"></path>
             <path fill-rule="evenodd" clip-rule="evenodd" d="M38.0273 41.2499C37.4891 41.2499 37.0522 40.8099 37.0522 40.2678C37.0522 33.3142 44.1409 25.5356 53.6283 25.5356C54.1665 25.5356 54.6033 25.9756 54.6033 26.5178C54.6033 27.0599 54.1665 27.4999 53.6283 27.4999C45.2564 27.4999 39.0024 34.2414 39.0024 40.2678C39.0024 40.8099 38.5655 41.2499 38.0273 41.2499Z" fill="#817AE3"></path>
             <path fill-rule="evenodd" clip-rule="evenodd" d="M97.5059 110H99.456V72.6785H97.5059V110Z" fill="#55547A"></path>
             <path fill-rule="evenodd" clip-rule="evenodd" d="M25.3516 110H27.3017V72.6785H25.3516V110Z" fill="#55547A"></path>
          </g>
          <defs>
             <clipPath id="clip0">
                <rect width="124.808" height="110" fill="white"></rect>
             </clipPath>
          </defs>
       </svg>
       <div align="center" class="row"><label class="col title">No customers yet!</label></div>
       <div class="row"><label align="center" class="description col mt-1">This section will contain the list of customers.</label></div>
       <div class="btn-container">
          <button type="button" class="mt-3 base-button btn btn-outline-primary btn-lg ">
             <!----> <!----> 
             Add New Customer
             <!---->
          </button>
       </div>
    </div>
    <div class="table-container">
       <div class="table-actions mt-5">
          <p class="table-stats">Showing: <b>1</b> of <b>1</b></p>
          <!---->
       </div>
       <div class="custom-control custom-checkbox"><input id="select-all" type="checkbox" class="custom-control-input"> <label for="select-all" class="custom-control-label selectall"><span class="select-all-label">Select All </span></label></div>
       <div class="table-component">
          <!----> 
          <div class="table-component__table-wrapper">
             <!----> 
             <table class="table-component__table table">
                <caption role="alert" aria-live="polite" class="table-component__table__caption">Table not sorted</caption>
                <thead class="table-component__table__head">
                   <tr>
                      <th aria-disabled="true" role="columnheader" class="table-component__th">
                      </th>
                      <th aria-sort="none" role="columnheader" class="table-component__th table-component__th--sort">
                         Display Name
                      </th>
                      <th aria-sort="none" role="columnheader" class="table-component__th table-component__th--sort">
                         Contact Name
                      </th>
                      <th aria-sort="none" role="columnheader" class="table-component__th table-component__th--sort">
                         Phone
                      </th>
                      <th aria-sort="none" role="columnheader" class="table-component__th table-component__th--sort">
                         Amount Due
                      </th>
                      <th aria-sort="none" role="columnheader" class="table-component__th table-component__th--sort">
                         Added On
                      </th>
                      <th aria-disabled="true" role="columnheader" class="table-component__th">
                      </th>
                   </tr>
                </thead>
                <tbody class="table-component__table__body">
                   <tr>
                      <td class="no-click">
                         <div class="custom-control custom-checkbox"><input id="2" type="checkbox" class="custom-control-input" value="2"> <label for="2" class="custom-control-label"></label></div>
                      </td>
                      <td><span>Display Name</span>marry</td>
                      <td><span>Contact Name</span>9898121234</td>
                      <td><span>Phone</span>9898121234</td>
                      <td>
                         <span> Amount Due </span> 
                         <div><span style="font-family: sans-serif">₹</span> 0.00</div>
                      </td>
                      <td><span>Added On</span>18 May 2020</td>
                      <td class="action-dropdown">
                         <span> Action </span> 
                         <div class="dropdown-group has-child toggle-arrow">
                            <div class="dropdown-activator">
                               <a href="#">
                                  <div>
                                     <div class="dot-icon"><span class="dot dot1"></span> <span class="dot dot2"></span> <span class="dot dot3"></span></div>
                                  </div>
                               </a>
                            </div>
                            <div class="dropdown-container align-right" style="display: none;">
                               <div class="dropdown-group-item">
                                  <a href="/admin/customers/2/edit" class="dropdown-item">
                                     <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="pencil-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="dropdown-item-icon svg-inline--fa fa-pencil-alt fa-w-16">
                                        <path fill="currentColor" d="M497.9 142.1l-46.1 46.1c-4.7 4.7-12.3 4.7-17 0l-111-111c-4.7-4.7-4.7-12.3 0-17l46.1-46.1c18.7-18.7 49.1-18.7 67.9 0l60.1 60.1c18.8 18.7 18.8 49.1 0 67.9zM284.2 99.8L21.6 362.4.4 483.9c-2.9 16.4 11.4 30.6 27.8 27.8l121.5-21.3 262.6-262.6c4.7-4.7 4.7-12.3 0-17l-111-111c-4.8-4.7-12.4-4.7-17.1 0zM124.1 339.9c-5.5-5.5-5.5-14.3 0-19.8l154-154c5.5-5.5 14.3-5.5 19.8 0s5.5 14.3 0 19.8l-154 154c-5.5 5.5-14.3 5.5-19.8 0zM88 424h48v36.3l-64.5 11.3-31.1-31.1L51.7 376H88v48z" class=""></path>
                                     </svg>
                                     Edit
                                  </a>
                               </div>
                               <div class="dropdown-group-item">
                                  <div class="dropdown-item">
                                     <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="dropdown-item-icon svg-inline--fa fa-trash fa-w-14">
                                        <path fill="currentColor" d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z" class=""></path>
                                     </svg>
                                     Delete
                                  </div>
                               </div>
                            </div>
                         </div>
                      </td>
                   </tr>
                </tbody>
                <tfoot></tfoot>
             </table>
          </div>
          <!----> 
          <div style="display: none;">
             <!----> <!----> <!----> <!----> <!----> <!----> <!---->
          </div>
          <!---->
       </div>
    </div>
 </div>
@endsection