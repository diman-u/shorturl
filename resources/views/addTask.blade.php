@extends('layouts/main')

@section('content')
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8 text-center">

            <h1>Оформление заявки</h1>

            <form role="form" method="post" id="addTask">
            {{ csrf_field() }}

                {{--Ремонт--}}
                <div class="row rowCenter remCheck">
                    <div class="col-md-6 output">
                        <input id="output" name="output" data-title="Выходной" type="checkbox">
                        <label>Выходной</label>
                    </div>
                    <div class="col-md-6 repairs">
                        <input id="repairs" name="repairs" data-title="Ремонт" type="checkbox">
                        <label>Ремонт</label>
                    </div>
                </div>

                <!-- Дата и время-->
                <div class="row rowCenter">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="date" class="required">Дата выполнения</label>
                            <input type="date" class="form-control" id="date" name="date">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="t_time" class="required">Время прибытия</label>
                            <input type="time" class="form-control" id="time" name="time">
                        </div>
                    </div>
                </div>
                <!-- Перевозимый груз-->
                <div class="form-group">
                    <label for="gruz" class="required">Перевозимый груз</label>
                    <input type="text" class="form-control" id="gruz" name="gruz">
                </div>
                <!-- Маршрут-->
                <div class="form-group">
                    <label for="path" class="required">Маршрут</label>
                    <input type="text" class="form-control" id="path" name="path">
                </div>
                <!-- Примерное время окончания-->
                <div class="col-4 form-group">
                    <label for="deadline" class="required">Примерное время окончания</label>
                    <input type="time" class="form-control" id="deadline" name="deadline">
                </div>
                <!-- Физик и Юрик-->
                <div class="row rowCenter">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input class="" type="checkbox" value="" id="fizik" name="fizik">
                            <label for="t_fiz">Физ.лицо</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="t_company" class="required">Компания</label>
                            <input type="text" placeholder="Название компании" class="form-control" id="zakaz" name="zakaz">
                            <input type="text" placeholder="Контактное лицо" class="form-control" id="contact" name="contact">
                        </div>
                    </div>
                </div>

                <!-- Телефоны-->
                <div class="row rowCenter">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="tel">
                                <span class="glyphicon glyphicon-phone-alt"></span>
                                Федеральный
                            </label>
                            <input type="text" class="form-control" id="tel" name="tel">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="gortel">Городской</label>
                            <input type="text" class="form-control" id="gortel" name="gortel">
                        </div>
                    </div>
                </div>

                <!-- Диспетчер -->
                <div class="col-12 form-group">
                    <div class="row rowCenter">
                        <div class="col-3">
                            <label for="disp" class="required">Диспетчер</label>
                            <select class="form-control" id="disp" name="disp">
                                <option value=""></option>
                                <option value="Женя">Женя</option>
                                <option value="Миша">Миша</option>
                            </select>
                        </div>

                        <div class="col-3 reklamaBlock">
                            <!-- Постоянщик -->
                            <input type="checkbox" id="reklama" name="reklama">
                            <label for="reklama">Постоянщик</label>
                        </div>
                    </div>
                </div>

                <!-- Марка машины -->
                <div class="col-12 form-group">
                    <div class="row rowCenter">
                        <div class="col-3">
                            <label for="marka" class="required">Марка машины</label>
                            <select class="form-control" id="marka" name="marka">
                                <option value=""></option>
                                <option value="Камаз">Камаз</option>
                                <option value="Маз">Маз</option>
                            </select>
                        </div>

                        <div class="col-3 pricepBlock">
                            <label for="checkbox" class="control-label">
                                <input name="pricep" id="pricep" type="checkbox"> С прицепом
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Комментарий -->
                <div class="form-group">
                    <label for="t_comment">Комментарий</label>
                    <textarea class="form-control" id="comment" rows="3" name="comment"></textarea>
                </div>

                {{--Перевозка--}}
                <div class="form-group">
                    <input name="perevoz" id="perevoz" type="checkbox">
                    <label class="control-label perevoz" for="perevoz">
                        Перевозка лесоматериала
                    </label>
                </div>

                <!-- Кол-во часов01-->
                <div class="row rowCenter">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="ch">Кол-во часов</label>
                            <input type="text" class="form-control" id="ch" name="ch">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="stavkach">Ставка / час</label>
                            <input type="text" class="form-control" id="stavkach" name="stavkach">
                        </div>
                    </div>
                </div>

                <!-- Кол-во часов02-->
                <div class="row rowCenter">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="km">Кол-во км</label>
                            <input type="text" class="form-control" id="km" name="km">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="stavkakm">Ставка / км</label>
                            <input type="text" class="form-control" id="stavkakm" name="stavkakm">
                        </div>
                    </div>
                </div>

                <!-- У кого деньги01-->
                <div class="row rowCenter">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="t_money01">У кого деньги</label>
                            <select class="form-control" id="money01" name="money01">
                                <option value=""></option>
                                <option value="Женя">Женя</option>
                                <option value="Миша">Миша</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="t_summa01">Сумма к оплате</label>
                            <input type="text" class="form-control" id="summa01" name="summa01">
                        </div>
                    </div>
                </div>

                <!-- У кого деньги02-->
                <div class="row rowCenter">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="t_money02">У кого деньги</label>
                            <select class="form-control" id="money02" name="money02">
                                <option value=""></option>
                                <option value="Женя">Женя</option>
                                <option value="Миша">Миша</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="summa02">Сумма к оплате</label>
                            <input type="text" class="form-control" id="summa02" name="summa02">
                        </div>
                    </div>
                </div>

                <!-- У кого деньги03-->
                <div class="row rowCenter">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="t_money03">У кого деньги</label>
                            <select class="form-control" id="money03" name="money03">
                                <option value=""></option>
                                <option value="Женя">Женя</option>
                                <option value="Миша">Миша</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="t_summa03">Сумма к оплате</label>
                            <input type="text" class="form-control" id="summa03" name="summa03">
                        </div>
                    </div>
                </div>

                <!-- Комментарий для бух -->
                <div class="form-group">
                    <label for="t_combuh">Комментарий для бухгалтера</label>
                    <textarea class="form-control" id="combuh" rows="3" name="combuh"></textarea>
                </div>

                <!-- Buttons-->
                <div class="row buttons">
                    <div class="col-md-6 text-right">
                        <button type="submit" class="btn btn-primary">Добавить</button>
                    </div>
                    <div class="col-md-6 text-left">
                        <button type="submit" class="btn btn-primary">Выход</button>
                    </div>
                </div>

            </form>
        </div>
        <div class="col-2"></div>
    </div>

@endsection