# -*- coding: utf-8 -*-

from flask import (
    Blueprint, render_template, session, redirect, url_for,
    request)

mod = Blueprint('admin', __name__, url_prefix='/admin')


@mod.route('/')
def index():
    return render_template('admin/index.html')

