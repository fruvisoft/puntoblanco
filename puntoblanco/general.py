# -*- coding: utf-8 -*-

from flask import (
    Blueprint, render_template, session, redirect, url_for,
    request)

mod = Blueprint('general', __name__)


@mod.route('/')
def index():
    return render_template('index.html')

