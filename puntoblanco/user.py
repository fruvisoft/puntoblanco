# -*- coding: utf-8 -*-

from flask import (
    Blueprint, render_template, session, redirect, url_for,
    request)

mod = Blueprint('user', __name__, url_prefix='/user')


@mod.route('/')
def index():
    return render_template('user/index.html')

