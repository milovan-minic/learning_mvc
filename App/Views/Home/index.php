{% extends "base.html" %}

{% block title %}Home{% endblock %}

{% block body %}

        <h1>Welcome</h1>

        <p>Hello from a Twig template, {{ name }}!</p>

        <ul>
            {% for colour in colours %}
                <li>{{ colour }}</li>
            {% endfor %}
        </ul>

{% end block %}