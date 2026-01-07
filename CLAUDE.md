# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## 项目概述

[PHP Log-reader](https://github.com/krissss/php-log-reader) for webman，为 webman 提供日志阅读界面。

**核心功能**：
- **零配置启动**：安装后直接访问 `/log-reader` 即可
- **仅 debug 模式启用**：生产环境自动关闭
- **Web 界面**：通过浏览器查看日志文件
- **实时更新**：支持日志文件实时查看

## 开发命令

测试、静态分析等通用命令与根项目一致，详见根目录 [CLAUDE.md](../../CLAUDE.md)。

## 项目架构

### 核心组件
- **Controller**：日志阅读控制器
- **LogReader**：日志读取器

### 目录结构
- `src/`：源代码
- `copy/config/plugin/`：配置文件模板
- `src/Install.php`：Webman 安装脚本

测试文件位于项目根目录的 `tests/Unit/LogReader/`。

## 代码风格

与根项目保持一致，详见根目录 [CLAUDE.md](../../CLAUDE.md)。

## 注意事项

1. **仅开发环境**：只在 debug 模式下启用
2. **日志路径**：确保日志文件路径可读
3. **大文件**：大日志文件可能影响性能
4. **安全考虑**：生产环境应关闭此功能
5. **测试位置**：单元测试在项目根目录的 `tests/Unit/LogReader/` 下，而非包内
