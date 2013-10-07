# -*- coding: utf-8 -*-

from flask import (
    Blueprint, render_template, session, redirect, url_for,
    request)

mod = Blueprint('order', __name__, url_prefix='/order')


@mod.route('/')
def index():
    return render_template('order/index.html')


@mod.route('/tables/')
def tables():
    return render_template('order/tables.html')


@mod.route('/table/<int:table_id>')
def table(table_id):
    #table_id = request.args.get('table_id', 0, type=int)
    return render_template('order/order.html', table_id=table_id)


@mod.route('/plates/')
def plates():
    return render_template('order/plates.html')