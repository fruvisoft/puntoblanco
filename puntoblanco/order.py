# -*- coding: utf-8 -*-

from flask import (
    Blueprint, render_template, session, redirect, url_for,
    request)

mod = Blueprint('order', __name__, url_prefix='/order')


@mod.route('/')
def index():
    return render_template('order/index.html')

